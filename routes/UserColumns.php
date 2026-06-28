<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\UserColumns\UserColumns as Route;
use WPSP\App\WordPress\UserColumns\custom_column;
use WPSP\App\WordPress\UserColumns\custom_column_view;
use WPSPCORE\App\Routes\UserColumns\UserColumnsRouteTrait;

class UserColumns {

	use UserColumnsRouteTrait;

	/*
	 *
	 */

	public function user_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}