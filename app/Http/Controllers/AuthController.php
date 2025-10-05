<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;
use Illuminate\Support\Facades\Hash;
use WPSP\app\Models\UsersModel;

class AuthController extends BaseController {

	private function wantJson($request) {
		return $request->get_header('Accept') === 'application/json';
	}

	public function login(\WP_REST_Request $request) {
		try {
			// Lấy nonce từ request
			$action = 'wp_rest';
//			$action = Funcs::instance()->_getAppShortName() . ('_auth_login');
			$nonce  = $request->get_param(Funcs::nonceName('auth_login'));


			// DEBUG: Xem tất cả params
			error_log('=== DEBUG LOGIN ===');
			error_log('All params: ' . print_r($request->get_params(), true));
			error_log('Body params: ' . print_r($request->get_body_params(), true));
			error_log('Query params: ' . print_r($request->get_query_params(), true));

			// Thử lấy nonce từ nhiều nguồn
			$nonce_from_param = $request->get_param('_wpnonce');
			$nonce_from_header = $request->get_header('X-WP-Nonce');

			error_log('Nonce from param: ' . $nonce_from_param);
			error_log('Nonce from header: ' . $nonce_from_header);

			// Thử verify
			$verify_param = wp_verify_nonce($nonce_from_param, 'wp_rest');
			$verify_header = wp_verify_nonce($nonce_from_header, 'wp_rest');

			error_log('Verify param result: ' . $verify_param);
			error_log('Verify header result: ' . $verify_header);
			error_log('=== END DEBUG ===');

			if (!$nonce || wp_verify_nonce($nonce, 'wp_rest') === false) {
				return new \WP_REST_Response(array(
					'success' => false,
					'message' => 'Invalid nonce.'
				), 403);
			}


			// Get parameters.
			$login    = sanitize_text_field($_POST['login'] ?? '');
			$password = (string)($_POST['password'] ?? '');
			$redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : (wp_get_referer() ?? $this->request->getRequestUri());

			// Check missing parameters.
			if (!$login || !$password) {
				if ($this->wantJson($request)) {
					wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'missing'], $redirect));
				}
				exit;
			}

			// Login attempt and fire an action if login failed.
			if (!wpsp_auth('web')->attempt(['login' => $login, 'password' => $password])) {
				if ($this->wantJson($request)) {
					wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'failed'], $redirect));
				}
				exit;
			}

			// if (!empty($_POST['remember'])) { ... }

			// Redirect after login success.
			if ($this->wantJson($request)) {
				wp_send_json([
					'success' => true,
					'data'    => [
						'user' => wpsp_auth('web')->user(),
					],
					'message' => 'Login successful',
				]);
			}
			else {
				wp_safe_redirect($redirect);
			}
			exit;
		}
		catch (\Throwable $e) {
			if ($this->wantJson($request)) {
				wp_send_json(['success' => false, 'message' => $e->getMessage()], 500);
			}
			else {
				wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
			}
			exit;
		}
	}

	public function logout(\WP_REST_Request $request) {
		wpsp_auth('web')->logout();
		wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
		exit;
	}

	public function me(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

	public function refreshToken(\WP_REST_Request $request) {
//		$user = Auth::guard('api')->user();
	}

}
