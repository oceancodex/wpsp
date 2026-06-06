<?php
namespace WPSP\App\WordPress\PostTypeColumns;

use Illuminate\Http\Request;
use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\PostTypeColumns\BasePostTypeColumn;

class custom_column extends BasePostTypeColumn {

	use InstancesTrait;

//	public $column_name             = 'custom_column';
	public $column_title            = 'Custom column';
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
	public $post_types              = ['post', 'wpsp_content', 'product'];
//	public $before_column           = [];
//	public $after_column            = ['title'];
//	public $position                = 2;
	public $sortable                = true;

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {}

	/*
	 *
	 */

//	public function customProperties(Request $request) {}

	/*
	 *
	 */

	public function index($column_name, $post_id, Request $request, TestService $testService) {
		echo $post_id;
	}

	/*
	 *
	 */

	public function sort($query) {
		if (!is_admin() || !$query->is_main_query()) return;

		$orderby = $query->get('orderby');

		if ($orderby === $this->column_name) {
			// Sort theo meta key.
			// $query->set('meta_key', 'your_meta_key');
			// $query->set('orderby', 'meta_value_num');

			$query->set('orderby', 'ID');
		}
	}

	/*
	 *
	 */

	public function afterInit() {
		// TODO: Implement afterInit() method.
	}

}