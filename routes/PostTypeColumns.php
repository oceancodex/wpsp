<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\PostTypeColumns\PostTypeColumns as Route;
use WPSP\App\WP\PostTypeColumns\custom_column;
use WPSPCORE\Routes\PostTypeColumns\PostTypeColumnsRouteTrait;

class PostTypeColumns {

	use PostTypeColumnsRouteTrait;

	public function post_type_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}