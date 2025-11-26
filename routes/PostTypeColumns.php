<?php

namespace WPSP\routes;

use WPSP\App\Components\PostTypeColumns\custom_column;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\PostTypeColumns\PostTypeColumnsRouteTrait;

class PostTypeColumns extends BaseRoute {

	use InstancesTrait, PostTypeColumnsRouteTrait;

	public function post_type_columns() {
		$this->column('custom_column', [custom_column::class, 'index'], true);
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}