<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\MetaBoxes\MetaBoxes as Route;
use WPSP\App\WordPress\MetaBoxes\wpsp_content;
use WPSP\App\WordPress\MetaBoxes\wpsp_dashboard_metabox;
use WPSPCORE\App\Routes\MetaBoxes\MetaBoxesRouteTrait;

class MetaBoxes {

	use MetaBoxesRouteTrait;

	/*
	 *
	 */

	public function meta_boxes() {
		Route::meta_box('wpsp_shortcode', [wpsp_content::class, 'index']);
		Route::meta_box('wpsp_dashboard_metabox', [wpsp_dashboard_metabox::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}