<?php

namespace WPSP\App\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\App\Http\Controllers\BaseController;

class AssetsController extends BaseController {

	public function frontend() {
//		wp_enqueue_style(config('app.short_name') . '-frontend', Funcs::asset('/css/frontend.min.css'), 9999, time());
//		wp_enqueue_script(config('app.short_name') . '-frontend', Funcs::asset('/js/web/main.min.js'), 9999, time(), true);

		wp_enqueue_script(config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), 9999, time(), ['in_footer' => 'true']);
		wp_enqueue_script(config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], time(), ['in_footer' => 'true']);
	}

	public function backend() {
		wp_enqueue_script(config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), 9999, time(), ['in_footer' => 'true']);
		wp_enqueue_script(config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], time(), ['in_footer' => 'true']);

//		wp_enqueue_script('dashboard');
		wp_enqueue_script('postbox');
	}

}