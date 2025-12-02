<?php

namespace WPSP\routes;

use WPSP\App\WP\UserMetaBoxes\custom_user_meta_box;
use WPSP\App\Instances\Routes\UserMetaBoxes\UserMetaBoxes as Route;
use WPSPCORE\App\Routes\UserMetaBoxes\UserMetaBoxesRouteTrait;

class UserMetaBoxes {

	use UserMetaBoxesRouteTrait;

	/*
	 *
	 */

	public function user_meta_boxes() {
		Route::user_meta_box('custom_user_meta_box', [custom_user_meta_box::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}