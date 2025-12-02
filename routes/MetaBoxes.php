<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\MetaBoxes\MetaBoxes as Route;
use WPSP\App\WP\MetaBoxes\wpsp_content;
use WPSPCORE\app\Routes\MetaBoxes\MetaBoxesRouteTrait;

class MetaBoxes {

	use MetaBoxesRouteTrait;

	/*
	 *
	 */

	public function meta_boxes() {
		Route::meta_box('wpsp_shortcode', [wpsp_content::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}