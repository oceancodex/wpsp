<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\Templates\Templates as Route;
use WPSP\App\WordPress\Templates\wpsp_bigger_content_font_size;
use WPSP\App\WordPress\Templates\wpsp_center_content;
use WPSP\App\WordPress\Templates\wpsp_right_content;
use WPSP\App\WordPress\Templates\wpsp_without_header_footer;
use WPSP\App\WordPress\Templates\wpsp_without_title;
use WPSPCORE\App\Routes\Templates\TemplatesRouteTrait;

class Templates {

	use TemplatesRouteTrait;

	/*
	 *
	 */

	public function templates() {
		Route::template('wpsp-without-title', [wpsp_without_title::class]);
		Route::template('wpsp-center-content', [wpsp_center_content::class]);
		Route::template('wpsp-without-header-footer', [wpsp_without_header_footer::class]);
		Route::template('wpsp-right-content', [wpsp_right_content::class]);
		Route::template('wpsp-bigger-content-font-size', [wpsp_bigger_content_font_size::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}