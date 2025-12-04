<?php

namespace WPSP\App\WordPress\ListTables;

use WPSP\App\Instances\Cache\Cache;
use WPSP\App\Instances\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ListTables\BaseListTable;

class Settings extends BaseListTable {

	use InstancesTrait;

	public $removeQueryVars = [
		'_wp_http_referer',
		'_wpnonce',
		'action',
		'action2',
		'filter_action',
		'id'
	];

	// Request parameters.
	private $page               = null;
	private $tab                = null;
	private $type               = null;
	private $search             = null;
	private $option             = null;
	private $paged              = null;
	private $total_items        = 0;
	private $orderby            = 'id';
	private $order              = 'asc';

	private $url                = null;
	private $itemsPerPage       = 10;

	/**
	 * Override construct to assign some variables.
	 */
	public function customProperties() {
		// Lấy tham số trên URL và gán vào biến để tái sử dụng.
		$this->page         = $this->request->get('page');                          // Admin page hiện tại.
		$this->paged        = $this->request->get('paged') ?: 0;                    // Phân trang hiện tại.
		$this->tab          = $this->request->get('tab');                           // Tab hiện tại.

		// Bộ lọc cho list table.
		$this->type         = $this->request->get('type');
		$this->search       = $this->request->get('s');                             // Search.
		$this->option       = $this->request->get('c');                             // Category.
		$this->orderby      = $this->request->get('orderby') ?: $this->orderby;     // Sắp xếp theo thứ tự nào.
		$this->order        = $this->request->get('order') ?: $this->order;         // Độ sắp xếp là giảm dần hay tăng dần.

		// Build URL hiện tại dựa theo tất cả các tham số trên để tái sử dụng.
		$this->url          = Funcs::_buildUrl($this->request->getBaseUrl(), ['page' => $this->page, 'tab' => $this->tab]);
		$this->url          .= $this->search ? '&s=' . $this->search : '';
		$this->url          .= $this->option ? '&c=' . $this->option : '';

		// Lấy số lượng mục hiển thị trên một trang.
		$this->itemsPerPage = $this->get_items_per_page($this->funcs->_slugParams(['page', 'tab']) . '_items_per_page');
	}

	/*
	 *
	 */

	/**
	 * Chuẩn bị dữ liệu để hiển thị.
	 */
	public function get_data() {
		try {
			$model = \WPSP\App\Models\SettingsModel::query();

			/**
			 * Cache total items.
			 */
			$this->total_items = Cache::remember('settings.total', 300, function() use ($model) {
				return $model->count();
			});

			$take = $this->itemsPerPage;
			$skip = ($this->paged - 1) * $take;

			/**
			 * Cache data.
			 */
			$pageKey = "settings.page.{$this->paged}.{$this->itemsPerPage}.{$this->orderby}.{$this->order}";
			$data    = Cache::remember($pageKey, 180, function() use ($skip, $take, $model) {
				return $model->orderBy($this->orderby, $this->order)
					->skip($skip)
					->take($take)
					->get()
					->toArray();
			});

			return $data;
		}
		catch (\Throwable $e) {
			return [
				['id' => 1, '_id' => 1, 'key' => 'Key 1', 'value' => 'Value 1'],
				['id' => 2, '_id' => 2, 'key' => 'Key 2', 'value' => 'Value 2'],
                ['id' => 3, '_id' => 3, 'key' => 'Key 3', 'value' => 'Value 3']
			];
		}
	}

	/**
	 * Tùy biến các column theo "name".\
	 * Ví dụ: column_name($item), column_email($item), ...
	 */
	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="items[]" value="%s" />',
			$item['_id'] ?? $item['id']
		);
	}

	public function get_columns() {
		return [
			'cb'    => '<input type="checkbox" />',
			'id'    => 'ID',
//			'_id'   => 'ID',
//			'name'  => 'Name',
//			'email' => 'Email',
			'key'   => 'Key',
			'value' => 'Value'
		];
	}

	public function column_default($item, $column_name) {
		switch ($column_name) {
			case 'id':
//			case '_id':
//			case 'name':
//			case 'email':
			case 'key':
			case 'value':
			default:
				return $item[$column_name];
		}
	}

	public function get_sortable_columns() {
		return [
			'id'    => ['id', false],
//			'_id'   => ['_id', false],
//			'name'  => ['name', false],
//			'email' => ['email', false],
			'key'   => ['key', false],
            'value' => ['value', false],
		];
	}

	public function column_name($item) {
		$actions = [
			'edit'   => sprintf('<a href="?page=%s&action=%s&item=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['name']),
			'delete' => sprintf('<a href="?page=%s&action=%s&item=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['name']),
		];

		return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions));
	}

	/**
	 * Prepare items.
	 */
	public function prepare_items() {

		// Handle bulk actions.
		$this->process_bulk_action();

		$data                  = $this->get_data();
		$this->_column_headers = $this->get_column_info();

		$this->set_pagination_args([
			'total_items' => $this->total_items,
			'per_page'    => $this->itemsPerPage,
		]);

		$this->items = $data;
	}

	/*
	 *
	 */

	/**
	 * View links.
	 */

	public function get_views() {
		return [
			'all'       => '<a href="' . $this->url . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(' . $this->total_items . ')</span></a>',
			'published' => '<a href="' . $this->url . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(' . $this->total_items . ')</span></a>',
		];
	}

	/**
	 * Bulk actions.
	 */

	public function get_bulk_actions() {

		// Prepare all bulk actions.
		return [
			'delete' => 'Delete',
		];
	}

	public function process_bulk_action() {

		// Security check.
		if (!empty($_REQUEST['_wpnonce']) && $nonce = $_REQUEST['_wpnonce']) {

			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				wp_die('Sorry, you are not allowed to access this page.');
			}

			// Multi delete.
			if ('delete' === $this->current_action()) {
				$items = $this->request->get('items');
				if (!empty($items)) {
					SettingsModel::query()->whereIn('id', $items)->delete();
				}
				Funcs::notice(Funcs::trans('Deleted successfully'), 'success', true);
			}

		}

	}

	/**
	 * Extra table nav.
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

}