<?php

namespace WPSP\App\WordPress\ListTables;

use WPSP\App\Services\TestService;
use WPSP\App\Widen\Support\Facades\Cache;
use WPSP\App\Widen\Traits\InstancesTrait;
use Spatie\Permission\Models\Permission as PermissionModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ListTables\BaseListTable;

class Permissions extends BaseListTable {

	use InstancesTrait;

	/*
	 *
	 */

	/**
	 * Khai báo "allowScreenIds" để có thể kích hoạt tính năng "hidden columns" và "items per page" trên những screen (màn hình) cụ thể.
	 *
	 * Ví dụ:
	 * - Admin page có screen id: "wpsp_page_wpsp_tab_roles"
	 * - List table này chỉ khai báo: "wpsp_page_wpsp_tab_list_users"
	 *
	 * Như vậy không khớp, "hidden columns" và "items per page" sẽ không được kích hoạt.\
	 * Mặc định "allowScreenIds" được đăng ký với tham số "page" trong URL.
	 */
	public $allowScreenIds = null;

	/**
	 * Tùy chỉnh "itemsPerPageKey" để lưu giá trị cho tính năng item per pages.
	 */
	public $itemsPerPageKey = null;

	/**
	 * Đặt là true để tự động enqueue JS cho bulk edit.\
	 * Đặt là false để custom enqueue JS cho bulk edit.\
	 * Mặc định "true" sẽ enqueue bulk-edit.js vào Custom List Table.
	 */
	public $bulkEditAssets = true;

	/**
	 * Request parameters.\
	 * Lấy các tham số trong URL thông qua helper Request.
	 */
	private $page         = null;	// Slug admin page hiện tại.
	private $tab          = null;	// Tab hiện tại.

	private $type         = null;	// Lọc theo loại (All | Publish | Trashed).
	private $search       = null;	// Chuỗi từ khóa tìm kiếm.
	private $filters      = null;	// Tất cả các bộ lọc với (name="filters[...]").

	private $paged        = null;	// Số trang hiện tại.
	private $total_items  = 0;		// Tổng số item (sử dụng để phân trang).
	private $orderby      = 'id';	// Sắp xếp theo cột nào.
	private $order        = 'desc';	// Kiểu sắp xếp (asc | desc)

	private $currentURL   = null;	// URL base hiện tại không bao gồm sort/paged
	private $itemsPerPage = 10;		// số dòng hiển thị trên 1 trang

	private TestService $testService;

	/*
	 *
	 */

	/**
	 * Khởi tạo các biến cần thiết để tái sử dụng.
	 */
	public function customProperties(TestService $testService) {
		$this->testService = $testService;

		/**
		 * ---
		 * Tùy chỉnh "allowScreenIds" phức tạp.\
		 * Hỗ trợ khai báo dưới dạng "string" hoặc "array".\
		 * Nếu "string" hoặc "array item" bắt đầu bằng đấu gạch chéo "/", xem như đó là Regex.
		 */
		$this->allowScreenIds = [
			$this->funcs->_getAppShortName() . '_page_wpsp_tab_permissions',
		];

		/**
		 * ---
		 * Tùy chỉnh "itemsPerPageKey" phức tạp.
		 */
//		$this->itemsPerPageKey = $this->funcs->_slugParams(['page', 'tab']) . '_items_per_page';

		/**
		 * ---
		 * Lấy các tham số từ URL.
		 */
		$this->page    = $this->request->query('page');		// Slug admin page
		$this->tab     = $this->request->query('tab');			// Tab hiện tại
		$this->paged   = $this->request->query('paged') ?: 1;	// Số trang hiện tại
		$this->type    = $this->request->query('type');		// Lọc theo loại (có thể là "All", "Published", "Trashed")
		$this->search  = $this->request->query('s');			// Từ khóa tìm kiếm

		// Lấy sort từ URL (nếu không có thì dùng mặc định).
		$this->orderby = $this->request->query('orderby') ?: $this->orderby;
		$this->order   = $this->request->query('order') ?: $this->order;

		// Tất cả các filters.
		$this->filters = $this->request->query('filters');		// Filters

		/**
		 * ---
		 * Build URL base giữ nguyên tất cả query đang dùng, chỉ loại những cái không cần.\
		 * URL này dùng để tạo link trong: phân trang, filters, view…
		 */
		$this->currentURL = Funcs::instance()->_buildUrl($this->request->getBaseUrl(), ['page' => $this->page, 'tab' => $this->tab]);
		$this->currentURL .= $this->search ? '&s=' . $this->search : '';

		/**
		 * ---
		 * Xử lý Filters.\
		 * Tự động nối các filter dạng multiple và dạng single vào "currentURL".
		 */
		if ($this->filters) {
			foreach ($this->filters as $filter => $value) {
				// Filter select thuộc dạng "multiple".
				if ($filter === 'select_multiple_name_1' || $filter === 'select_multiple_name_2') {
					foreach ($value as $k => $v) {
						$this->currentURL .= '&filter['.$filter.']['.$k.']=' . $v;
					}
				}
				// Filter select không phải dạng "multiple" hoặc inputs.
				else {
					$this->currentURL .= '&filter['.$filter.']=' . $value;
				}
			}
		}

		/**
		 * Lấy items per page từ User meta.
		 */
		$this->itemsPerPage = $this->get_items_per_page($this->itemsPerPageKey);
	}

	/**
	 * Thực hiện các hành động cần thiết sau khi class được khởi tạo.
	 *
	 * @return void
	 */
	public function afterInstanceConstruct() {
		/**
		 * Xử lý bulk actions.
		 */
		$this->process_bulk_action();
	}

	/*
	 *
	 */

	/**
	 * ---
	 * View links.
	 * ---
	 * Tạo các link filter phía trên bảng (All, Published…)
	 */
	public function get_views() {
		return [
			'all'       => '<a href="' . $this->currentURL . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(' . $this->total_items . ')</span></a>',
//			'published' => '<a href="' . $this->currentURL . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(' . $this->total_items . ')</span></a>',
		];
	}

	/**
	 * ---
	 * Bulk actions.
	 * ---
	 * Khai báo danh sách bulk actions.
	 */
	public function get_bulk_actions() {
		return [
			'bulk_edit' => 'Bulk Edit',
			'delete'    => 'Delete',
		];
	}

	/**
	 * Xử lý bulk action khi user bấm Apply.
	 */
	public function process_bulk_action() {
		// Nếu không có action, không thực thi.
		if (!$this->current_action()) {
			return;
		}

		// Kiểm tra nonce bảo mật
		if (!empty($_REQUEST['_wpnonce']) && $nonce = $_REQUEST['_wpnonce']) {

			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				wp_die('Sorry, you are not allowed to access this page.');
			}

			// Bulk delete
			if ('delete' === $this->current_action()) {
				$items = $this->request->query('items');
				if (!empty($items)) {
					PermissionModel::query()->whereIn('id', $items)->delete();
				}

				// Notice hiển thị trên admin
				Funcs::notice(Funcs::trans('Deleted successfully'), 'success');
			}
		}

		// Chuyển hướng, loại bỏ các params thừa.
		$this->redirectBulkActions(['items'], ['saved' => true]);
	}

	/**
	 * Bulk edit form.
	 */
	public function bulk_edit_form() {
		echo Funcs::view('admin-pages.wpsp.users.bulk-edit')->with(['testService' => $this->testService]);
	}


	/**
	 * ---
	 * Extra table nav.
	 * ---
	 * Hiển thị filter phía trên bảng (dropdown + button)\
	 * Sử dụng để mở rộng tính năng filter khác.
	 */
	public function extra_tablenav($which) {
		if ($which == 'top') {
			echo '<div class="alignleft actions bulkactions">';
			echo '<select name="c" id="filter-by-sites"><option value="">Select category</option>';
			echo '<option value="category_1">Category 1</option>';
			echo '</select>';
			echo '<input type="submit" name="filter_action" class="button" value="Filter"/>';
			echo '</div>';
		}
	}


	/**
	 * ---
	 * Columns.
	 * ---
	 * Khai báo các cột hiển thị trong bảng.
	 */
	public function get_columns() {
		return [
			'cb'         => '<input type="checkbox" />',
			'id'         => 'ID',
			'name'       => 'Name',
			'guard_name' => 'Guard name'
		];
	}

	/**
	 * Cho phép sort các cột.\
	 * false -> không sort theo default.
	 */
	public function get_sortable_columns() {
		return [
			'id'         => ['id', false],
			'name'       => ['name', false],
			'guard_name' => ['guard_name', false],
		];
	}

	/**
	 * Danh sách các cột bị ẩn mặc định.\
	 * Trả về mảng rỗng để cho phép WP hiển thị tất cả checkbox ở Screen Options.
	 */
	public function get_hidden_columns() {
		return [];
	}

	/**
	 * Hiển thị dữ liệu cho mỗi cell (trừ cột tùy biến)
	 */
	public function column_default($item, $column_name) {
		switch ($column_name) {
			case 'id':
			case 'name':
			case 'guard_name':
			default:
				return $item[$column_name] ?? null;
		}
	}

	/**
	 * Cột checkbox của WP_List_Table. Dùng cho bulk action.
	 */
	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="items[]" value="%s" />',
			$item['_id'] ?? $item['id']
		);
	}

	/**
	 * Ví dụ mẫu về column có row actions (view/edit/delete)
	 */
	public function column_name($item) {
		$actions = [
			'custom' => '<a href="/admin.php?page=custom&edit=' . $item['id'] . '">Custom</a>',
			'show'   => '<a href="' . Funcs::route('AdminPages', 'wpsp.permissions.show', ['permission' => $item['id']], true) . '">Show</a>',
			'edit'   => '<a href="' . Funcs::route('AdminPages', 'wpsp.permissions.edit', ['id' => $item['id']], true) . '">Edit</a>',
			'delete' => '<a href="' . Funcs::route('AdminPages', 'wpsp.permissions.delete', ['id' => $item['id']], true) . '">Delete</a>',
		];

		return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions));
	}


	/**
	 * ---
	 * Data.
	 * ---
	 * Truy vấn database và trả về danh sách dữ liệu cho bảng.
	 */
	public function get_data() {
		try {
			$model = PermissionModel::query();

			/**
			 * Cache tổng số lượng bản ghi trong 300s\
			 * Dùng để tối ưu phân trang (pagination)
			 */
			$this->total_items = $model->count();

			$take = $this->itemsPerPage;          // Số item mỗi trang
			$skip = ($this->paged - 1) * $take;   // Offset trong SQL

			return $model->orderBy($this->orderby, $this->order)->skip($skip)->take($take)->get()->toArray();
		}
		catch (\Throwable $e) {
			global $wp_roles;
			$all_capabilities = [];
			foreach ($wp_roles->roles as $role_key => $role_data) {
				foreach ($role_data['capabilities'] as $cap => $grant) {
					$all_capabilities[$cap] = true; // true/false tuỳ grant
				}
			}
			$capabilities = array_keys($all_capabilities);
			$capabilities = array_map(
				function($key, $value) {
					return [
						'id'         => $key+1,
						'_id'        => $key+1,
						'name'       => $value,
						'guard_name' => null,
					];
				},
				array_keys($capabilities),
				$capabilities
			);

			$this->total_items = count($capabilities);

			$take = $this->itemsPerPage;
			$skip = ($this->paged - 1) * $take;

			return array_slice($capabilities, $skip, $take);
		}
	}


	/**
	 * ---
	 * Prepare items.
	 * ---
	 * Hàm bắt buộc của WP_List_Table.\
	 * Load data, set pagination, register column headers.
	 */
	public function prepare_items() {
		// Lấy data.
		$data = $this->get_data();

		// Đăng ký header, sortable, hidden columns
		$screen   = get_current_screen();
		$columns  = $this->get_columns();
		$hidden   = get_hidden_columns($screen);
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = [$columns, $hidden, $sortable];

		// Gửi thông tin phân trang cho WP_List_Table
		$this->set_pagination_args([
			'total_items' => $this->total_items,
			'per_page'    => $this->itemsPerPage,
		]);

		// Đổ dữ liệu vào bảng
		$this->items = $data;
	}

}
