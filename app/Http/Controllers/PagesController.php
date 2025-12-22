<?php

namespace WPSP\App\Http\Controllers;

use Illuminate\Http\Request;
use WPSPCORE\App\Http\Controllers\BaseController;

class PagesController extends BaseController {

	public function index() {
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r('OK'); echo '</pre>';
	}

	public function content($content) {
		return $content . ' _Filtered_';
	}

	public function demo($param) {
//		return $param;
	}

}