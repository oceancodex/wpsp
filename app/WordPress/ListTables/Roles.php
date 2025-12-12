<?php

namespace WPSP\App\WordPress\ListTables;

use WPSP\App\Widen\Support\Facades\Cache;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ListTables\BaseListTable;

class Roles extends BaseListTable {

	use InstancesTrait;

	/**
	 * Danh sách các query var cần loại bỏ khỏi URL khi xử lý redirect.\
	 * Thường dùng sau khi submit form bulk action để tránh lặp lại action cũ.
	 */
	public $removeQueryVars = [
		'_wp_http_referer',
		'_wpnonce',
		'action',
		'action2',
		'filter_action',
		'id',
	];

	/**
	 * Request parameters.\
	 * Lấy từ URL thông qua helper Request riêng của hệ thống.
	 */
	private $page         = null; // trang admin hiện tại (slug)
	private $tab          = null; // tab trong page (nếu có)
	private $type         = null; // loại filter
	private $search       = null; // chuỗi tìm kiếm
	private $option       = null; // category filter
	private $paged        = null; // số trang hiện tại (phân trang)
	private $total_items  = 0;    // tổng số item để phân trang
	private $orderby      = 'id'; // sắp xếp theo cột nào
	private $order        = 'asc';// thứ tự asc|desc

	private $url          = null; // URL base hiện tại không bao gồm sort/paged
	private $itemsPerPage = 10;   // số dòng hiển thị trên 1 trang

	/**
	 * Khởi tạo các biến cần thiết để tái sử dụng.
	 */
	public function customProperties() {

		// Lấy tham số từ URL (request)
		$this->page  = $this->request->get('page'); // slug page admin
		$this->paged = $this->request->get('paged') ?: 1; // số trang phân trang
		$this->tab   = $this->request->get('tab'); // tab hiện tại nếu có

		// Lấy filter
		$this->type   = $this->request->get('type'); // filter loại item
		$this->search = $this->request->get('s'); // từ khóa tìm kiếm
		$this->option = $this->request->get('c'); // category

		// Lấy sort từ URL (nếu không có dùng mặc định)
		$this->orderby = $this->request->get('orderby') ?: $this->orderby;
		$this->order   = $this->request->get('order') ?: $this->order;

		/**
		 * Build URL base giữ nguyên tất cả query đang dùng, chỉ loại những cái không cần.
		 * URL này dùng để tạo link trong: phân trang, filter, view…
		 */
		$this->url = Funcs::instance()->_buildUrl($this->request->getBaseUrl(), ['page' => $this->page, 'tab' => $this->tab]);
		$this->url .= $this->search ? '&s=' . $this->search : '';
		$this->url .= $this->option ? '&c=' . $this->option : '';

		/**
		 * Lấy số item hiển thị mỗi trang từ user meta (WordPress tự lưu sau khi user chọn Screen Options)
		 */
		$this->itemsPerPage = $this->get_items_per_page($this->funcs->_slugParams(['page', 'tab']) . '_items_per_page');
	}

	/*
	 * View links.
	 */

	/**
	 * Tạo các link filter phía trên bảng (All, Published…)
	 */
	public function get_views() {
		return [
			'all'       => '<a href="' . $this->url . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(' . $this->total_items . ')</span></a>',
			'published' => '<a href="' . $this->url . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(' . $this->total_items . ')</span></a>',
		];
	}

	/*
	 * Bulk actions.
	 */

	/**
	 * Khai báo danh sách bulk actions.
	 */
	public function get_bulk_actions() {
		return [
			'delete' => 'Delete',
		];
	}

	/**
	 * Xử lý bulk action khi user bấm Apply.
	 */
	public function process_bulk_action() {

		// Kiểm tra nonce bảo mật
		if (!empty($_REQUEST['_wpnonce']) && $nonce = $_REQUEST['_wpnonce']) {

			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				wp_die('Sorry, you are not allowed to access this page.');
			}

			// Bulk delete
			if ('delete' === $this->current_action()) {
				$items = $this->request->get('items');
				if (!empty($items)) {
					SettingsModel::query()->whereIn('id', $items)->delete();
				}

				// Notice hiển thị trên admin
				Funcs::notice(Funcs::trans('Deleted successfully'), 'success', true);
			}
		}
	}

	/*
	 * Extra table nav.
	 */

	/**
	 * Hiển thị filter phía trên bảng (dropdown + button)\
	 * Sử dụng để mở rộng tính năng filter khác.
	 */
	public function extra_tablenav($which) {

		if ($which == 'top') {
			echo '<div class="alignleft actions bulkactions">';
			echo '<select name="c" id="filter-by-sites"><option value="">Select options</option>';
			echo '<option value="option_1">Option 1</option>';
			echo '</select>';
			echo '<input type="submit" name="filter_action" class="button" value="Filter"/>';
			echo '</div>';
		}

	}

	/*
	 * Columns.
	 */

	/**
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
				return $item[$column_name];
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
	 * Ví dụ mẫu về column có action (edit/delete)\
	 */
	public function column_name($item) {
		$actions = [
			'edit'   => sprintf('<a href="?page=%s&action=%s&item=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['name']),
			'delete' => sprintf('<a href="?page=%s&action=%s&item=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['name']),
		];

		return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions));
	}

	/*
	 * Data.
	 */

	/**
	 * Truy vấn database và trả về danh sách dữ liệu cho bảng.
	 */
	public function get_data() {
		try {
			$model = \Spatie\Permission\Models\Role::query();

			/**
			 * Cache tổng số lượng bản ghi trong 300s
			 * Dùng để phân trang (pagination)
			 */
			$this->total_items = $model->count();

			$take = $this->itemsPerPage;          // số item mỗi trang
			$skip = ($this->paged - 1) * $take;   // offset trong SQL

			return $model->orderBy($this->orderby, $this->order)->skip($skip)->take($take)->get()->toArray();
		}
		catch (\Throwable $e) {
			global $wp_roles;
			$roles = $wp_roles->get_names();
			$roles = array_keys($roles);
			$roles = array_map(function($label, $key) {
				return [
					'id'         => $key+1,
					'_id'        => $key+1,
					'name'       => $label,
					'guard_name' => null,
				];
			}, $roles, array_keys($roles));

			$this->total_items = count($roles);

			$take = $this->itemsPerPage;
			$skip = ($this->paged - 1) * $take;

			return array_slice($roles, $skip, $take);
		}
	}

	/*
	 * Load data and prepare for display.
	 */

	/**
	 * Hàm bắt buộc của WP_List_Table.\
	 * Load data, set pagination, register column headers.
	 */
	public function prepare_items() {

		// Xử lý bulk action trước.
		$this->process_bulk_action();

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
