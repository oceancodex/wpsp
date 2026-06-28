<?php
namespace WPSP\App\WordPress\TaxonomyColumns;

use Illuminate\Http\Request;
use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\TaxonomyColumns\BaseTaxonomyColumn;

class custom_column_view extends BaseTaxonomyColumn {

	use InstancesTrait;

//	public column_name              = 'custom_column_view';
	public $column_title            = 'Custom column view';
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
	public $taxonomies              = ['category', 'wpsp_category', 'product_cat'];
//	public $before_column           = [];
//	public $after_column            = ['name'];
	public $position                = 2;
	public $sortable                = true;

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function index($content, $column_name, $term_id, Request $request, TestService $testService) {
//		echo $term_id . ' - ' . $testService->test() . ' > ' . $testService->subTestService->subTest();
		Funcs::view('taxonomy-columns.custom_column_view');
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