<?php

namespace WPSP\App\Http\Controllers;

use Illuminate\Http\Request;
use WPSPCORE\App\Http\Controllers\BaseController;

class PagesController extends BaseController {

	public function index(Request $request) {
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r('OK'); echo '</pre>';
	}

	public function content($content, Request $request) {
		return $content . ' _Filtered_';
	}

	public function demo($param) {
//		return $param;
	}

	/**
	 * Thêm các scripts và nonce cho trang user edit hoặc profile để kéo thả sắp xếp các meta boxes.
	 */
	public function edit_user_screen($screen) {
		if ($screen->id == 'user-edit' || $screen->id == 'profile') {
			add_action('admin_enqueue_scripts', function() {
//				wp_enqueue_script('dashboard');
				wp_enqueue_script('postbox');
			});

			add_action('personal_options', function() {
			    wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);
			    wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
			});

			add_filter('screen_options_show_screen', '__return_true', 10, 2);
		}
	}

}