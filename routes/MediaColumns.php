<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\MediaColumns\MediaColumns as Route;
use WPSP\App\WordPress\MediaColumns\custom_column;
use WPSPCORE\App\Routes\MediaColumns\MediaColumnsRouteTrait;

class MediaColumns {

	use MediaColumnsRouteTrait;

	/*
	 *
	 */

	public function media_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}