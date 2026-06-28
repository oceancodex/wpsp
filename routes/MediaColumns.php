<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\MediaColumns\MediaColumns as Route;
use WPSP\App\WordPress\MediaColumns\custom_column;
use WPSP\App\WordPress\MediaColumns\custom_column_view;
use WPSPCORE\App\Routes\MediaColumns\MediaColumnsRouteTrait;

class MediaColumns {

	use MediaColumnsRouteTrait;

	/*
	 *
	 */

	public function media_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}