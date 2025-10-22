<?php
namespace WPSP\app\Extras\Components\PostTypeColumns;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BasePostTypeColumn;

class custom_column extends BasePostTypeColumn {

	use InstancesTrait;

//	public $column                  = null;
	public $column_add_priority     = 9999;
	public $column_content_priority = 9999;
//	public $post_types              = ['post'];
//	public $before_column           = [];
//	public $after_column            = ['title'];
//	public $position                = 2;
	public $sortable                = true;
//	public $callback_function       = null;

	public function customProperties() {}

	public function index($column, $postId) {
		echo $postId;
	}

	public function sort($query) {
		if (!is_admin() || !$query->is_main_query()) {
			return;
		}

		$orderby = $query->get('orderby');

		if ($orderby === 'custom_column') {
			$query->set('orderby', 'ID');
		}
	}

}