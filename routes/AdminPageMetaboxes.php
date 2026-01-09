<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\AdminPageMetaboxes\AdminPageMetaboxes as Route;
use WPSP\App\WordPress\AdminPageMetaboxes\wpsp\tab_settings;
use WPSPCORE\App\Routes\AdminPageMetaboxes\AdminPageMetaboxesRouteTrait;

class AdminPageMetaboxes {

	use AdminPageMetaboxesRouteTrait;

	/*
	 *
	 */

	public function admin_page_metaboxes() {
		Route::name('wpsp.')->group(function() {
			Route::meta_box('tab_settings', [tab_settings::class, 'render'])->name('tab_settings');
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}