<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\Shortcodes\Shortcodes as Route;
use WPSP\App\WP\Shortcodes\custom_shortcode;
use WPSP\App\WP\Shortcodes\rewrite_front_page_content;
use WPSP\App\WP\Shortcodes\wpsp_content;
use WPSPCORE\Routes\Shortcodes\ShortcodesRouteTrait;

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