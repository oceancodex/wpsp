<?php

namespace WPSP\App\Http\Controllers;

use Inertia\Inertia;
use WPSPCORE\App\Http\Controllers\BaseController;

class WebController extends BaseController {

	public function index() {
		return Inertia::render('Index');
	}

	public function test() {
		return Inertia::render('Test');
	}

}