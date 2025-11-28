<?php
namespace WPSP\App\WP\PostTypeColumns;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\WP\PostTypeColumns\BasePostTypeColumn;

class custom_column extends BasePostTypeColumn {

	use InstancesTrait;

//	public $column                  = null;
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
	public $post_types              = ['post', 'wpsp_content'];
//	public $before_column           = [];
//	public $after_column            = ['title'];
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

	public function index($column, $postId) {
		echo $postId;
	}

	/*
	 *
	 */

	public function sort($query) {
		if (!is_admin() || !$query->is_main_query()) return;

		$orderby = $query->get('orderby');

		if ($orderby === 'custom_column') {
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