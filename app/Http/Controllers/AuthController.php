<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;
use Illuminate\Support\Facades\Hash;
use WPSP\app\Models\UsersModel;

class AuthController extends BaseController {

	public function login(\WP_REST_Request $request) {
	}

	/**
	 * Đăng xuất và xóa API token
	 */
	public function logout(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

	/**
	 * Lấy thông tin user hiện tại
	 */
	public function me(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

	/**
	 * Làm mới API token
	 */
	public function refreshToken(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

}
