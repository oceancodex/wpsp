<?php

namespace WPSP\routes;

use WPSP\app\Extras\Components\PostTypeColumns\custom_column;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\PostTypeColumnsRouteTrait;

class PostTypeColumns extends BaseRoute {

	use InstancesTrait, PostTypeColumnsRouteTrait;

	public function post_type_columns() {
		$this->column('custom_column', [custom_column::class, 'index'], true);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}