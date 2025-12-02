<?php

namespace WPSP\App\Http\Controllers;

use WPSPCORE\App\Http\Controllers\BaseController;

class AssetsController extends BaseController {

	public function frontend() {
//		wp_enqueue_style(config('app.short_name') . '-frontend', Funcs::asset('/css/frontend.min.css'), 9999, time());
//		wp_enqueue_script(config('app.short_name') . '-frontend', Funcs::asset('/js/modules/web/main.min.js'), 9999, time(), true);
	}

}