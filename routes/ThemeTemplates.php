<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\ThemeTemplates\ThemeTemplates as Route;
use WPSP\App\WordPress\ThemeTemplates\wpsp_bigger_content_font_size;
use WPSP\App\WordPress\ThemeTemplates\wpsp_center_content;
use WPSP\App\WordPress\ThemeTemplates\wpsp_right_content;
use WPSP\App\WordPress\ThemeTemplates\wpsp_without_header_footer;
use WPSP\App\WordPress\ThemeTemplates\wpsp_without_title;
use WPSPCORE\App\Routes\ThemeTemplates\ThemeTemplatesRouteTrait;

class ThemeTemplates {

	use ThemeTemplatesRouteTrait;

	/*
	 *
	 */

	public function theme_templates() {
		Route::theme_template('wpsp-without-title', [wpsp_without_title::class]);
		Route::theme_template('wpsp-center-content', [wpsp_center_content::class]);
		Route::theme_template('wpsp-without-header-footer', [wpsp_without_header_footer::class]);
		Route::theme_template('wpsp-right-content', [wpsp_right_content::class]);
		Route::theme_template('wpsp-bigger-content-font-size', [wpsp_bigger_content_font_size::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}