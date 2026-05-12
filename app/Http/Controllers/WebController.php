<?php

namespace WPSP\App\Http\Controllers;

use Inertia\Inertia;
use WPSPCORE\App\Http\Controllers\BaseController;

class WebController extends BaseController {

	public function index() {
//		echo view('app');
		return Inertia::render('User/Show', [
			'user' => $user
		]);
	}

}