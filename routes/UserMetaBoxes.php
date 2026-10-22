<?php

namespace WPSP\Routes;

use WPSP\App\Widen\Routes\UserMetaBoxes\UserMetaBoxes as Route;
use WPSP\App\WordPress\UserMetaBoxes\custom_user_meta_box;
use WPSPCORE\App\Routes\UserMetaBoxes\UserMetaBoxesRouteTrait;

class UserMetaBoxes {

	use UserMetaBoxesRouteTrait;

	/*
	 *
	 */

	public function user_meta_boxes() {
//		Route::name('wpsp_user_meta_boxes.')->prefix('wpsp-user-meta-boxes')->group(function() {
			Route::user_meta_box('custom_user_meta_box', [custom_user_meta_box::class, 'index']);
//		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}