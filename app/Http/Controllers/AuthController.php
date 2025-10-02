<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;
use Illuminate\Support\Facades\Hash;
use WPSP\app\Models\UsersModel;

class AuthController extends BaseController {

	public function login(\WP_REST_Request $request) {}

	public function logout(\WP_REST_Request $request) {}

	public function me(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

	public function refreshToken(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

}
