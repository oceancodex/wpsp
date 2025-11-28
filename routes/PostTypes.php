<?php

namespace WPSP\routes;

use WPSP\App\WP\PostTypes\wpsp_content;
use WPSP\App\Instances\Routes\PostTypes as Route;
use WPSPCORE\Routes\PostTypes\PostTypesRouteTrait;

class PostTypes {

	use PostTypesRouteTrait;

	public function post_types() {
		Route::post_type('wpsp_content', [wpsp_content::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}