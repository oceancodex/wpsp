<?php

namespace WPSP\App\WordPress\FrontPages;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\FrontPages\BaseFrontPage;

class front_page_demo extends BaseFrontPage {

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
		echo $endpoint;
	}

	public function update(Request $request) {
		global $post;
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($post); echo '</pre>';
		print_r($request->all());
		die();
	}

}