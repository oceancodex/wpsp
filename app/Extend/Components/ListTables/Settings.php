<?php

namespace WPSP\app\Extend\Components\ListTables;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\Base\BaseListTable;
use WPSPCORE\Traits\HttpRequestTrait;

class Settings extends BaseListTable {

	use HttpRequestTrait;

//	public ?string $defaultOrder    = 'asc';
//	public ?string $defaultOrderBy  = 'id';
	public ?array  $removeQueryVars = [
		'_wp_http_referer',
		'_wpnonce',
		'action',
		'action2',
		'filter_action',
		'id'
	];

	// Request parameters.
	private ?string $page        = null;
	private ?string $tab         = null;
	private ?string $type        = null;
	private ?string $search      = null;
	private ?string $option      = null;
	private ?string $paged       = null;
	private ?int    $total_items = 0;
	private ?string $orderby     = 'id';
	private ?string $order       = 'asc';

	private ?string $url          = null;
	private ?int    $itemsPerPage = 10;

	/**
	 * Override construct to assign some variables.
	 */
	public function customProperties(): void {
		$this->page         = self::request()->get('page');
		$this->paged        = self::request()->get('paged');
		$this->tab          = self::request()->get('tab');
		$this->type         = self::request()->get('type');
		$this->search       = self::request()->get('s');
		$this->option       = self::request()->get('c');
		$this->orderby      = self::request()->get('orderby') ?: $this->orderby;
		$this->order        = self::request()->get('order') ?: $this->order;

		$this->url          = Funcs::instance()->_buildUrl(self::request()->getBaseUrl(), ['page' => $this->page, 'tab' => $this->tab]);
		$this->url          .= $this->search ? '&s=' . $this->search : '';
		$this->url          .= $this->option ? '&c=' . $this->option : '';

		$prefixScreenOption = Funcs::env('APP_SHORT_NAME', true) . '_' . $this->page;
		$this->itemsPerPage = $this->get_items_per_page($prefixScreenOption . '_items_per_page');
	}

	/*
	 *
	 */

	/**
	 * Data.
	 */

	public function get_data(): array {
//		$model             = \WPSP\app\Models\AccountsModel::query();
		$model             = \WPSP\app\Models\SettingsModel::query();
//		$model             = \WPSP\app\Models\VideosModel::query();

		$totalCacheKey = 'list_table_settings_total_items';
//		Cache::delete($totalCacheKey);
		$this->total_items = Cache::get($totalCacheKey, function(ItemInterface $item) use ($model) {
			return $model->count();
		});

//		$this->total_items = $model->count();
		$take              = $this->itemsPerPage;
		$skip              = ($this->paged - 1) * $take;

		$dataCacheKey = 'list_table_settings_' . $this->itemsPerPage . '_' . $this->paged;
//		Cache::delete($dataCacheKey);
		return Cache::get($dataCacheKey, function (ItemInterface $item) use ($model, $take, $skip) {
			$item->expiresAfter(60); // Cache in seconds.
			return $model->orderBy($this->orderby, $this->order)->skip($skip)->take($take)->get()->toArray();
		});
	}

	/**
	 * Columns.
	 */

	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="items[]" value="%s" />',
			$item['_id'] ?? $item['id']
		);
	}

	public function get_columns(): array {
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

	public function get_sortable_columns(): array {
		return [
			'id'    => ['id', false],
//			'_id'   => ['_id', false],
//			'name'  => ['name', false],
//			'email' => ['email', false],
			'key'   => ['key', false],
            'value' => ['value', false],
		];
	}

	public function column_name($item): string {
		$actions = [
			'edit'   => sprintf('<a href="?page=%s&action=%s&item=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['name']),
			'delete' => sprintf('<a href="?page=%s&action=%s&item=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['name']),
		];

		return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions));
	}

	/**
	 * Prepare items.
	 */

	public function prepare_items(): void {

		// Handle bulk actions.
		$this->process_bulk_action();

		$data                  = $this->get_data();
		$this->_column_headers = $this->get_column_info();

//		usort($data, [&$this, 'usort_reorder']);

//		$per_page     = $this->get_items_per_page(Funcs::env('APP_SHORT_NAME', true) . '_' . $this->page . '_items_per_page');
//		$current_page = $this->get_pagenum();
//		$total_items  = count($data);
//		$data         = array_slice($data, (($current_page - 1) * $per_page), $per_page);

		$this->set_pagination_args([
			'total_items' => $this->total_items,
			'per_page'    => $this->itemsPerPage,
			'total_pages' => ceil($this->total_items / $this->itemsPerPage),
		]);

		$this->items = $data;
	}

	/*
	 *
	 */

	/**
	 * View links.
	 */

	public function get_views(): array {
		return [
			'all'       => '<a href="' . $this->url . '" class="' . (($this->type == 'all' || !$this->type) ? 'current' : '') . '">All <span class="count">(10)</span></a>',
			'published' => '<a href="' . $this->url . '&type=published" class="' . ($this->type == 'published' ? 'current' : '') . '">Published <span class="count">(5)</span></a>',
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
				$items = self::request()->get('items');
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

	public function extra_tablenav($which): void {

		if ($which == 'top') {
			echo '<div class="alignleft actions bulkactions">';
			echo '<select name="c" id="filter-by-sites"><option value="">Select options</option>';
			echo '<option value="option_1">Option 1</option>';
			echo '</select>';
			echo '<input type="submit" name="filter_action" class="button" value="Filter"/>';
			echo '</div>';
		}

	}

	/**
	 * Other functions.
	 */

	public function usort_reorder($a, $b): int {
		$orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : $this->defaultOrderBy;
		$order   = (!empty($_GET['order'])) ? $_GET['order'] : $this->defaultOrder;
		$result  = strnatcmp($a[$orderby], $b[$orderby]);
		return ($order === 'asc') ? $result : -$result;
	}

}