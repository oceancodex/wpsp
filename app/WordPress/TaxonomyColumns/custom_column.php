<?php
namespace WPSP\App\WordPress\TaxonomyColumns;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\TaxonomyColumns\BaseTaxonomyColumn;

class custom_column extends BaseTaxonomyColumn {

	use InstancesTrait;

//	public $column                  = null;
	public $column_title            = 'Custom column';
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
	public $taxonomies              = ['category', 'wpsp_category'];
//	public $before_column           = [];
//	public $after_column            = ['name'];
//	public $position                = 2;
	public $sortable                = true;
//	public $callback_function       = null;

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function index($content, $columnName, $termId) {
		echo $termId;
	}

	/*
	 *
	 */

	public function sort($query) {
		if (!is_admin()) return;

		$orderby = $query->query_vars['orderby'] ?? null;

		if ($orderby === 'custom_column') {
			// Sort theo meta key.
//			$query->query_vars['meta_key'] = 'icon';
//			$query->query_vars['orderby'] = 'meta_value';

			$query->query_vars['orderby'] = 'term_id';
		}
	}

}