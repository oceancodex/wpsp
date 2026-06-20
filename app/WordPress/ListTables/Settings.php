<?php

namespace WPSP\App\WordPress\ListTables;

use WPSP\App\Widen\Support\Facades\Cache;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ListTables\BaseListTable;

class Settings extends BaseListTable {

	use InstancesTrait;

	/**
	 * Khai báo screen options key để list table này được khởi tạo.
	 * Mục đích để ép List Table này chỉ hiển thị ở những màn hình (screenId) cụ thể.\
	 * Ví dụ:\
	 * - Admin page có screen id: **wpsp_page_wpsp_tab_roles**\
	 * - List table này chỉ khai báo: **wpsp_page_wpsp_tab_list_users**\
	 *
	 * Như vậy không khớp, screen option columns và items per page sẽ không được khởi tạo.\
	 * Mặc định "screenOptionsKey" được đăng ký với URL param: "page".
	 */
//	public $screenOptionsKey = null;

	/**
	 * Request parameters.\
	 * Lấy từ URL thông qua helper Request riêng của hệ thống.
	 */
	private $page         = null; 	// trang admin hiện tại (slug)
	private $tab          = null; 	// tab trong page (nếu có)

	private $type         = null; 	// View link (All | Publish | Trashed)
	private $search       = null; 	// chuỗi tìm kiếm
	private $filters      = null;   // filters

	private $paged        = null; 	// số trang hiện tại (phân trang)
	private $total_items  = 0;    	// tổng số item để phân trang
	private $orderby      = 'id'; 	// sắp xếp theo cột nào
	private $order        = 'desc';	// thứ tự asc|desc

	private $currentURL   = null; 	// URL base hiện tại không bao gồm sort/paged
	private $itemsPerPage = 10;   	// số dòng hiển thị trên 1 trang

	/**
	 * Khởi tạo các biến cần thiết để tái sử dụng.
	 */
	public function customProperties() {
		/**
		 * Tùy chỉnh "screenOptionsKey". Có thể khai báo string hoặc array.\
		 * Mục đích để ép List Table này chỉ hiển thị ở những màn hình (screenId) cụ thể.\
		 * Ví dụ:\
		 * - Admin page có screen id: **wpsp_page_wpsp_tab_roles**\
		 * - List table này chỉ khai báo: **wpsp_page_wpsp_tab_list_users**\
		 *
		 * Như vậy không khớp, screen option columns và items per page sẽ không được khởi tạo.
		 */
		$this->screenOptionsKey = [
			$this->funcs->_getAppShortName() . '_page_wpsp_tab_settings',
			$this->funcs->_getAppShortName() . '_page_wpsp_tab_table',
		];

		// Lấy tham số từ URL (request)
		$this->page  = $this->request->query('page');          	// slug page admin
		$this->paged = $this->request->query('paged') ?: 1;		// số trang phân trang
		$this->tab   = $this->request->query('tab');           	// tab hiện tại nếu có

		// Lấy filter
		$this->type    = $this->request->query('type');        // filter loại item
		$this->search  = $this->request->query('s');           // từ khóa tìm kiếm
		$this->filters = $this->request->query('filters');     // filters

		// Lấy sort từ URL (nếu không có dùng mặc định)
		$this->orderby = $this->request->query('orderby') ?: $this->orderby;
		$this->order   = $this->request->query('order') ?: $this->order;

		/**
		 * Build URL base giữ nguyên tất cả query đang dùng, chỉ loại những cái không cần.
		 * URL này dùng để tạo link trong: phân trang, filter, view…
		 */
		$this->currentURL = Funcs::instance()->_buildUrl($this->request->getBaseUrl(), ['page' => $this->page, 'tab' => $this->tab]);
		$this->currentURL .= $this->search ? '&s=' . $this->search : '';

		/**
		 * Filters.
		 */
		if ($this->filters) {
			foreach ($this->filters as $filter => $value) {
				// Filter select multiple.
				if ($filter === 'select_multiple_filter') {
					foreach ($value as $k => $v) {
						$this->currentURL .= '&filter['.$filter.']['.$k.']=' . $v;
					}
				}
				// Filter select một giá trị.
				else {
					$this->currentURL .= '&filter['.$filter.']=' . $value;
				}
			}
		}

		/**
		 * Lấy số item hiển thị mỗi trang từ user meta (WordPress tự lưu sau khi user chọn Screen Options)
		 */
		$this->itemsPerPage = $this->get_items_per_page($this->funcs->_slugParams(['page', 'tab']) . '_items_per_page');
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
	 * View links.
	 */

	/**
	 * Tạo các link filter phía trên bảng (All, Published…)
	 */
	public function get_views() {
		return [
			'all'       => '<a href="' . $this->currentURL . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(' . $this->total_items . ')</span></a>',
			'published' => '<a href="' . $this->currentURL . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(' . $this->total_items . ')</span></a>',
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
					SettingsModel::query()->whereIn('id', $items)->delete();
				}

				// Notice hiển thị trên admin
				Funcs::notice(Funcs::trans('Deleted successfully'), 'success');
			}
		}

		// Chuyển hướng, loại bỏ các params thừa.
		$this->redirectBulkActions(['items'], ['saved' => true]);
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
			echo '<select name="c" id="filter-by-sites"><option value="">Select category</option>';
			echo '<option value="category_1">Category 1</option>';
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
			'cb'    => '<input type="checkbox" />', // cột checkbox
			'id'    => 'ID',
			'label' => 'Value',
			'key'   => 'Key',
		];
	}

	/**
	 * Cho phép sort các cột.\
	 * false -> không sort theo default.
	 */
	public function get_sortable_columns() {
		return [
			'id'    => ['id', false],
			'key'   => ['key', false],
			'value' => ['value', false],
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
			case 'key':
			case 'value':
			default:
				return $item[$column_name] ?? $item['model']->$column_name ?? '';
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
	 * Ví dụ mẫu về column có action (edit/delete)
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
//			$model = SettingsModel::query();
			$data = SettingsModel::hierarchyPaginate(
				$this->itemsPerPage,
				$this->paged,
				'parent_setting_id',
				'value',
				$this->orderby,
				$this->order,
			);
			$items = $data['items'];

			/**
			 * Cache tổng số lượng bản ghi trong 300s\
			 * Dùng để tối ưu phân trang (pagination)
			 */
//			$this->total_items = Cache::remember('settings.total', 300, function() use ($model) {
//				return $model->count();
//			});
			$this->total_items = $data['total'] ?? 0;

//			$take = $this->itemsPerPage;          // số item mỗi trang
//			$skip = ($this->paged - 1) * $take;   // offset trong SQL

			/**
			 * Tạo key riêng cho mỗi trang và mỗi trạng thái order.
			 */
//			$pageKey = "settings.page.{$this->paged}.{$this->itemsPerPage}.{$this->orderby}.{$this->order}";

			/**
			 * Cache dữ liệu cho mỗi trang.\
			 * Dùng để tối ưu phân trang (pagination)
			 */
//			$data = Cache::remember($pageKey, 180, function() use ($skip, $take, $model) {
//				/**
//				 * Query thực tế: ORDER + LIMIT + OFFSET
//				 */
//				return $model->orderBy($this->orderby, $this->order)
//					->skip($skip)
//					->take($take)
//					->get()
//					->toArray();
//			});

			return $items;
		}
		catch (\Throwable $e) {

			/**
			 * Nếu lỗi database, trả về dummy data tránh crash admin page
			 */
			return [
				['id' => 1, '_id' => 1, 'key' => 'Key 1', 'value' => 'Value 1'],
				['id' => 2, '_id' => 2, 'key' => 'Key 2', 'value' => 'Value 2'],
				['id' => 3, '_id' => 3, 'key' => 'Key 3', 'value' => 'Value 3'],
			];
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
