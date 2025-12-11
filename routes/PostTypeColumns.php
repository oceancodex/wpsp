<?php

namespace WPSP\routes;

use WPSP\App\Extends\Routes\PostTypeColumns\PostTypeColumns as Route;
use WPSP\App\WordPress\PostTypeColumns\custom_column;
use WPSPCORE\App\Routes\PostTypeColumns\PostTypeColumnsRouteTrait;

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