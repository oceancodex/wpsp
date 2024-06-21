<?php

namespace WPSP\app\Http\Controllers;

use WPSPCORE\Base\BaseController;

class AssetsController extends BaseController {

	public function frontend(): void {
//		wp_enqueue_style(config('app.short_name') . '-frontend', WPSP_PUBLIC_URL . '/css/frontend.min.css', 9999, time());
//		wp_enqueue_script(config('app.short_name') . '-frontend', WPSP_PUBLIC_URL . '/js/modules/web/main.min.js', 9999, time(), true);
	}

}