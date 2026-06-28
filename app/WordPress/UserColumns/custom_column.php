<?php
namespace WPSP\App\WordPress\UserColumns;

use Illuminate\Http\Request;
use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\UserColumns\BaseUserColumn;

class custom_column extends BaseUserColumn {

	use InstancesTrait;

//	public $column_name             = 'custom_column';
	public $column_title            = 'Custom column';
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
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

	public function index($output, $column_name, $user_id, Request $request, TestService $testService) {
		return $column_name . ' - ' . $user_id . ' - ' . $testService->test() . ' > ' . $testService->subTestService->subTest();
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

			$query->query_vars['orderby'] = 'user_id';
		}
	}

}