<?php

namespace WPSP\routes;

use WPSP\App\Extends\Routes\Shortcodes\Shortcodes as Route;
use WPSP\App\WordPress\Shortcodes\custom_shortcode;
use WPSP\App\WordPress\Shortcodes\rewrite_front_page_content;
use WPSP\App\WordPress\Shortcodes\wpsp_content;
use WPSPCORE\App\Routes\Shortcodes\ShortcodesRouteTrait;

class Shortcodes {

	use ShortcodesRouteTrait;

	public function shortcodes() {
		Route::shortcode('wpsp_content', [wpsp_content::class, 'index']);
		Route::shortcode('rewrite_front_page_content', [rewrite_front_page_content::class, 'index']);
		Route::shortcode('custom_shortcode', [custom_shortcode::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}