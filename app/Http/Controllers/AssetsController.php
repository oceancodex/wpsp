<?php

namespace WPSP\App\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\App\Http\Controllers\BaseController;

class AssetsController extends BaseController {

	public function frontend() {
//		wp_enqueue_style(Funcs::config('app.short_name') . '-frontend', Funcs::asset('/css/frontend.min.css'), 9999, time());
//		wp_enqueue_script(Funcs::config('app.short_name') . '-frontend', Funcs::asset('/js/web/main.min.js'), 9999, time(), true);

		if (Funcs::env('WPSP_APP_DEBUG_LIVE_RELOAD') === 'true') {
			wp_enqueue_script(Funcs::config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), 9999, time(), ['in_footer' => 'true']);
			wp_enqueue_script(Funcs::config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], time(), ['in_footer' => 'true']);
		}
	}

	public function backend() {
		wp_enqueue_style(Funcs::config('app.short_name') . '-backend', Funcs::asset('/scss/admin.min.css'), 9999, time());

		if (Funcs::env('WPSP_APP_DEBUG_LIVE_RELOAD') === 'true') {
			wp_enqueue_script(Funcs::config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), 9999, time(), ['in_footer' => 'true']);
			wp_enqueue_script(Funcs::config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], time(), ['in_footer' => 'true']);
		}

//		wp_enqueue_script('dashboard');
		wp_enqueue_script('postbox');

		wp_enqueue_script(Funcs::config('app.short_name') . '-backend', Funcs::asset('/ts/app.min.js'), 9999, time(), true);
	}

}