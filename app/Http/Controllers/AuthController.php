<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;
use Illuminate\Support\Facades\Hash;
use WPSP\app\Models\UsersModel;
use WPSPCORE\Sanctum\Database\TokenDatabase;

class AuthController extends BaseController {

	// Login by submit form login.
	public function login(\WP_REST_Request $request) {
		try {
			// Lấy nonce từ request Rest API.
			$action = 'wp_rest';
			$nonce  = $request->get_param('_wpnonce');

			if (!$nonce || !wp_verify_nonce($nonce, $action)) {
				return new \WP_REST_Response([
					'success' => false,
					'message' => 'Invalid nonce.',
				], 403);
			}


			// Get parameters.
			$login    = sanitize_text_field($_POST['login'] ?? '');
			$password = (string)($_POST['password'] ?? '');
			$redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : (wp_get_referer() ?? $this->request->getRequestUri());

			// Check missing parameters.
			if (!$login || !$password) {
				if ($this->wantJson()) {
					wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'missing'], $redirect));
				}
				exit;
			}

			// Login attempt and fire an action if login failed.
			if (!wpsp_auth('web')->attempt(['login' => $login, 'password' => $password])) {
				if ($this->wantJson()) {
					wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'failed'], $redirect));
				}
				exit;
			}

			// if (!empty($_POST['remember'])) { ... }

			// Redirect after login success.
			if ($this->wantJson()) {
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
			if ($this->wantJson()) {
				wp_send_json(['success' => false, 'message' => $e->getMessage()], 500);
			}
			else {
				wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
			}
			exit;
		}
	}

	// Logout by sbumit form logout.
	public function logout(\WP_REST_Request $request) {
		wpsp_auth('web')->logout();
		if ($this->wantJson()) {
			wp_send_json([
				'success' => true,
				'data'    => null,
				'message' => 'Logout successful',
			]);
		}
		wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
		exit;
	}

	/*
	 *
	 */

	public function sanctumLogin(\WP_REST_Request $request) {
		$login    = $request->get_param('login');
		$password = $request->get_param('password');

		// Authenticate user
		$user = wp_authenticate($login, $password);
		if (is_wp_error($user)) {
			return new \WP_Error('login_failed', 'Invalid credentials', ['status' => 401]);
		}

		// Tạo token database instance
		$tokenDb = new TokenDatabase();

		// Tạo token - generates plain token và lưu hashed version
		$result = $tokenDb->createToken(
			$user->ID,
			'mobile-app',
			['read', 'write'],
			null
		);

		// $result chứa:
		// - plainTextToken: "abc123def456..." (GỬI CHO CLIENT)
		// - accessToken: PersonalAccessToken object (hashed token trong DB)

		return [
			'success'    => true,
			'token'      => $result['plainTextToken'], // ← Client lưu cái này
			'token_type' => 'Bearer',
			'user'       => [
				'id' => $user->ID,
			],
		];
	}

}
