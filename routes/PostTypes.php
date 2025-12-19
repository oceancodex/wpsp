<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\PostTypes\PostTypes as Route;
use WPSP\App\WordPress\PostTypes\wpsp_content;
use WPSPCORE\App\Routes\PostTypes\PostTypesRouteTrait;
use WPSP\App\WordPress\PostTypes\test;

class PostTypes {

	use PostTypesRouteTrait;

	public function post_types() {
		Route::post_type('test', [test::class]);
		Route::post_type('wpsp_content', [wpsp_content::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}