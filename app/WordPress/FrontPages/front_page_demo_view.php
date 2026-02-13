<?php

namespace WPSP\App\WordPress\FrontPages;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\FrontPages\BaseFrontPage;

class front_page_demo_view extends BaseFrontPage {

	use InstancesTrait;
	/*
	 *
	 */

	public function customProperties() {
//		$this->path = 'front-page\/([^\/]+)\/?$';
	}

	/*
	 *
	 */

	public function index(Request $request, $endpoint = null) {
		echo Funcs::view('front-pages.font_page_demo_view');
		die();
//		echo $endpoint;
	}

	public function update(Request $request) {
		print_r($request->all());
		die();
	}

}