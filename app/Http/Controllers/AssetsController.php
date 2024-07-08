<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class AssetsController extends BaseController {

	public function frontend(): void {
//		wp_enqueue_style(config('app.short_name') . '-frontend', Funcs::asset('/css/frontend.min.css'), 9999, time());
//		wp_enqueue_script(config('app.short_name') . '-frontend', Funcs::asset('/js/modules/web/main.min.js'), 9999, time(), true);
	}

}