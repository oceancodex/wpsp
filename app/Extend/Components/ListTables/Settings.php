<?php

namespace WPSP\app\Extend\Components\ListTables;

use WPSP\Funcs;
use WPSPCORE\Base\BaseListTable;
use WPSPCORE\Traits\HttpRequestTrait;

class Settings extends BaseListTable {

	use HttpRequestTrait;

	public ?string $defaultOrder   = 'asc';
	public ?string $defaultOrderby = 'id';
	public ?array  $removeQueryVar = [
		'_wp_http_referer',
		'_wpnonce',
		'action',
		'action2',
		'filter_action',
		'id'
	];

	private ?string $page   = null;
	private ?string $tab    = null;
	private ?string $type   = null;
	private ?string $search = null;
	private ?string $url    = null;
	private ?string $paged  = null;

	/**
	 * Override construct to assign some variables.
	 */
	public function __construct($args = []) {
		parent::__construct($args);
		$this->page   = self::request()->get('page');
		$this->tab    = self::request()->get('tab');
		$this->search = self::request()->get('s');
		$this->option = self::request()->get('c');
		$this->type   = self::request()->get('type');
		$this->url    = Funcs::instance()->_buildUrl(self::request()->getBaseUrl(), [
			'page' => $this->page,
			'tab'  => $this->tab,
		]);
		$this->url    .= $this->search ? '&s=' . $this->search : '';
		$this->url    .= $this->option ? '&c=' . $this->option : '';
	}

	/**
	 * Data.
	 */

	public function get_data(): array {
		return \WPSP\app\Models\AccountsModel::all()->toArray();
//		return [
//			[
//				'id'    => 1,
//				'key'   => 'key1',
//				'value' => 'value1',
//			],
//			[
//				'id'    => 2,
//				'key'   => 'key2',
//				'value' => 'value2',
//			],
//			[
//				'id'    => 3,
//				'key'   => 'key3',
//				'value' => 'value3',
//			],
//			[
//				'id'    => 4,
//				'key'   => 'key4',
//				'value' => 'value4',
//			],
//			[
//				'id'    => 5,
//				'key'   => 'key5',
//				'value' => 'value5',
//			],
//		];
	}

	/**
	 * View links.
	 */

	public function get_views(): array {
		return [
			'all'       => '<a href="' . $this->url . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(10)</span></a>',
			'published' => '<a href="' . $this->url . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(10)</span></a>'
		];
	}

	/**
	 * Columns.
	 */

	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="items[]" value="%s" />',
			$item['id']
		);
	}

	public function get_columns(): array {
		return [
			'cb'    => '<input type="checkbox" />',
			'id'    => 'ID',
			'name'  => 'Name',
			'email' => 'Email',
		];
	}

	public function column_default($item, $column_name) {
		switch ($column_name) {
			case 'id':
			case 'name':
			case 'email':
			default:
				return $item[$column_name];
		}
	}

	public function get_sortable_columns(): array {
		return [
			'id'    => ['id', false],
			'name'  => ['name', false],
			'email' => ['email', false],
		];
	}

	/**
	 * Bulk actions.
	 */

	public function get_bulk_actions(): array {

		// Prepare all bulk actions.
		return [
			'delete' => 'Delete',
		];
	}

	public function process_bulk_action(): void {

		// Security check.
		if (!empty($_REQUEST['_wpnonce']) && $nonce = $_REQUEST['_wpnonce']) {

			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				wp_die('Sorry, you are not allowed to access this page.');
			}

			// Multi delete.
			if ('delete' === $this->current_action()) {
				echo '<pre style="z-index: 9999; position: relative; clear: both;">'; print_r(self::request()->query->all()); echo '</pre>';
				Funcs::notice(Funcs::trans('Deleted successfully'), 'success', true);
			}

		}

	}

	/**
	 * Prepare items.
	 */

	public function prepare_items(): void {

		// Handle bulk actions.
		$this->process_bulk_action();

		$data                  = $this->get_data();
		$this->_column_headers = $this->get_column_info();

		usort($data, [&$this, 'usort_reorder']);

		/* Pagination */
		$per_page     = $this->get_items_per_page(Funcs::env('APP_SHORT_NAME', true) . '_' . $this->page . '_items_per_page');
		$current_page = $this->get_pagenum();
		$total_items  = count($data);

		$data = array_slice($data, (($current_page - 1) * $per_page), $per_page);

		$this->set_pagination_args([
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil($total_items / $per_page),
		]);

		$this->items = $data;
	}

	public function usort_reorder($a, $b): int {
		$orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : $this->defaultOrderby;
		$order   = (!empty($_GET['order'])) ? $_GET['order'] : $this->defaultOrder;
		$result  = strnatcmp($a[$orderby], $b[$orderby]);
		return ($order === 'asc') ? $result : -$result;
	}

	/**
	 * Extra table nav.
	 */
	protected function extra_tablenav($which): void {

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