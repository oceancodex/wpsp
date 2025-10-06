<?php

namespace WPSP\app\Http\Controllers;

use WPSP\Funcs;
use WPSPCORE\Base\BaseController;
use Illuminate\Support\Facades\Hash;
use WPSP\app\Models\UsersModel;
use WPSPCORE\Sanctum\Database\DBPersonalAccessToken;

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

		$guard = wpsp_auth('api');

		if ($guard->attempt(['login' => $login, 'password' => $password])) {
			$user = $guard->user();
			
			echo '<pre>'; print_r($user->tokens); echo '</pre>'; die();

			try {
				// Create token with specific abilities
				$result = $user->createToken('api-token', [
					'read:posts',
					'create:posts',
					'edit:posts',
				]);

				return [
					'success' => true,
					'token'   => $result['plainTextToken'],
					'user'    => $user->toArray(),
				];
			}
			catch (\Exception $e) {
				echo '<pre>'; print_r($user->toArray()); echo '</pre>';
				// Token đã tồn tại, xóa và thử lại
				echo '<pre>'; print_r($user->tokens()->get()->toArray()); echo '</pre>'; die();

				return [
					'success' => true,
					'token'   => $result['plainTextToken'],
					'user'    => $user->toArray(),
				];
			}
		}

		return ['success' => false, 'message' => 'Invalid credentials'];
	}

}
