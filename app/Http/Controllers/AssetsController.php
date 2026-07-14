<?php

namespace WPSP\App\Http\Controllers;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Http\Controllers\BaseController;

class AssetsController extends BaseController {

	use InstancesTrait;

	/*
	 *
	 */

	public $version = null;

	/*
	 *
	 */

	public function __instanceConstruct() {
		$this->version = Funcs::getVersion();
	}

	/*
	 *
	 */

	public function frontend() {
//		wp_enqueue_style(Funcs::config('app.short_name') . '-frontend', Funcs::asset('/css/frontend.min.css'), null, $this->version);
//		wp_enqueue_script(Funcs::config('app.short_name') . '-frontend', Funcs::asset('/js/web/main.min.js'), null, $this->version, true);

		if (Funcs::config('app.debug_live_reload')) {
			wp_enqueue_script(Funcs::config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), null, $this->version, ['in_footer' => 'true']);
			wp_enqueue_script(Funcs::config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], $this->version, ['in_footer' => 'true']);
		}
	}

	public function backend() {
		wp_enqueue_style(Funcs::config('app.short_name') . '-backend-scss', Funcs::asset('/scss/admin.min.css'), null, $this->version);

		if (Funcs::config('app.debug_live_reload')) {
			wp_enqueue_script(Funcs::config('app.short_name') . '-socketio', Funcs::asset('widen/plugins/socketio/socket.io.min.js'), null, $this->version, ['in_footer' => 'true']);
			wp_enqueue_script(Funcs::config('app.short_name') . '-live-reload', Funcs::asset('node/live-reload.js'), ['jquery'], $this->version, ['in_footer' => 'true']);
		}

//		wp_enqueue_script('dashboard');
		wp_enqueue_script('postbox');
		wp_enqueue_script(Funcs::config('app.short_name') . '-backend-app', Funcs::asset('/ts/app.min.js'), null, $this->version, true);
	}

}