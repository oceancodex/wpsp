<?php

namespace WPSP\routes;

use WPSP\App\WordPress\AdminPageMetaboxes\test;
use WPSP\App\Widen\Routes\AdminPageMetaboxes\AdminPageMetaboxes as Route;
use WPSPCORE\App\Routes\AdminPageMetaboxes\AdminPageMetaboxesRouteTrait;

class AdminPageMetaboxes {

	use AdminPageMetaboxesRouteTrait;

	/*
	 *
	 */

	public function admin_page_metaboxes() {
		Route::meta_box('test', [test::class, 'render']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}