<?php

namespace WPSP\App\WordPress\FrontPages;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\FrontPages\BaseFrontPage;

class front_page_demo extends BaseFrontPage {

	use InstancesTrait;

	public $path = 'front-page-demo';

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
		global $post, $wp_query;
		echo 'REST API Nonce: <strong>' . wp_create_nonce('wp_rest') . '</strong>';
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($request->route('n')); echo '</pre>';
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($request->route('queries')); echo '</pre>';
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($endpoint); echo '</pre>';
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($post); echo '</pre>';
		echo '<hr/>';
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($wp_query); echo '</pre>';
		die();
//		echo $endpoint;
	}

	public function update(Request $request) {
		print_r($request->all());
		die();
	}

}