<?php

namespace WPSP\Routes;

use WPSP\App\Widen\Routes\PostTypeColumns\PostTypeColumns as Route;
use WPSP\App\WordPress\PostTypeColumns\custom_column;
use WPSP\App\WordPress\PostTypeColumns\custom_column_view;
use WPSPCORE\App\Routes\PostTypeColumns\PostTypeColumnsRouteTrait;

class PostTypeColumns {

	use PostTypeColumnsRouteTrait;

	/*
	 *
	 */

	public function post_type_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}