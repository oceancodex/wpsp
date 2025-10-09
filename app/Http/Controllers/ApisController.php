<?php

namespace WPSP\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Models\PersonalAccessTokenModel;
use WPSP\app\Models\UsersModel;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApisController extends BaseController {

	public function wpsp(\WP_REST_Request $request): array {

		// Rate limit for 10 requests per 30 seconds based on the user display name or request IP address.
		try {
			$rateLimitKey           = 'api_wpsp_' . (wp_get_current_user()->display_name ?? $this->request->getClientIp());
			$rateLimitByIp          = RateLimiter::get('api', $rateLimitKey)->consume();
			$rateLimitByIpRemaining = $rateLimitByIp->getRemainingTokens();
			$rateLimitByIpAccepted  = $rateLimitByIp->isAccepted();
		}
		catch (\Exception|\Throwable $e) {
			$rateLimitByIpAccepted  = true;
			$rateLimitByIpRemaining = null;
		}

		if (false === $rateLimitByIpAccepted) {
			return Funcs::response(false, ['rate_limit_remaining' => $rateLimitByIpRemaining], 'Rate limit exceeded. Please try again later.', 429);
		}

		return Funcs::response(true, ['rate_limit_remaining' => $rateLimitByIpRemaining], 'This is a new API end point!', 200);

	}

	/*
	 *
	 */

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

	public function getApiToken(\WP_REST_Request $request) {
		$login    = sanitize_text_field($request->get_param('login'));
		$password = $request->get_param('password');
		$refresh  = filter_var($request->get_param('refresh'), FILTER_VALIDATE_BOOL);

		if (!$login || !$password) {
			wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
		}

		$auth = wpsp_auth('api')->attempt(['login' => $login, 'password' => $password]);

		if (!$auth) {
			wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
		}

		$user = $auth->user();
		if (($user && $refresh) || !$user->api_token) {
			$user->api_token = Str::random(64);
			$user->save();
		}

		wp_send_json([
			'success' => true,
			'data'    => [
				'api_token' => $user->api_token,
				'user'      => $user,
			],
			'message' => 'API token retrieved',
		]);

	}

	public function testApiToken(\WP_REST_Request $request) {
		wp_send_json([
			'success' => true,
			'data'    => [
				'user' => wpsp_auth('api')->user(),
				'parameters' => $request->get_params(),
			],
			'message' => 'API token retrieved',
		]);
	}

	/*
	 *
	 */

	public function wpRestNonce(\WP_REST_Request $request) {
		$nonce = wp_create_nonce('wp_rest');
		wp_send_json([
			'success' => true,
			'data'    => [
				'nonce' => $nonce,
			],
			'message' => 'Nonce retrieved',
		]);
	}

	public function testKeepLogin(\WP_REST_Request $request) {
		$user = wpsp_auth('web')->user() ?? null;
		if ($user) {
			$user = $user->toArray();
			wp_send_json([
				'success' => true,
				'data'    => [
					'user' => $user,
				],
				'message' => 'User retrieved',
			]);
		}
		else {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => 'User not found',
			]);
		}
	}

	/*
	 *
	 */

	public function sanctumGenerateAccessToken(\WP_REST_Request $request) {
		$login    = $request->get_param('login');
		$password = $request->get_param('password');

		if (wpsp_auth('sanctum')->attempt(['login' => $login, 'password' => $password])) {

			/** @var UsersModel $user */
			$user = wpsp_auth('sanctum')->user();

			try {
				// Create token with specific abilities
				$tokenName = 'api-token';
				$result    = $user->createToken($tokenName, [
					'read:posts',
					'create:posts',
					'edit:posts',
				], '1 year');

				if ($result) {
					return [
						'success' => true,
						'data'    => [
							'name'          => $tokenName,
							'access_token'  => $result['token'],
							'refresh_token' => $result['refresh_token'],
						],
						'message' => 'Generate access token successful',
					];
				}
				else {
					return [
						'success' => false,
						'data'    => null,
						'message' => 'Token name "' . $tokenName . '" already exists',
					];
				}
			}
			catch (\Exception $e) {
				return [
					'success' => false,
					'data'    => null,
					'message' => $e->getMessage(),
				];
			}
		}

		return ['success' => false, 'message' => 'Invalid credentials'];
	}

	public function sanctumRefreshAccessToken(\WP_REST_Request $request) {
		$refreshToken = $this->funcs->_getBearerToken();

		if (!$refreshToken) {
			return [
				'success' => false,
				'data'    => null,
				'message' => 'Invalid refresh token',
			];
		}

		// Get token from database.
		$token = PersonalAccessTokenModel::query()->where('refresh_token', hash('sha256', $refreshToken))->first();

		if (!$token) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => 'Invalid refresh token',
			], 401);
			exit;
		}

		// Tạo token mới
		$plainToken     = sprintf(
			'%s%s%s',
			$this->funcs->_config('sanctum.token_prefix', ''),
			$tokenEntropy = Str::random(64),
			hash('crc32b', $tokenEntropy)
		);
		$newAccessToken = hash('sha256', $plainToken);

		$token->update([
			'token'      => $newAccessToken,
			'expires_at' => Carbon::now()->addDays(60),
		]);

		wp_send_json([
			'success' => true,
			'data'    => [
				'access_token'  => $token->getKey() . '|' . $plainToken,
				'refresh_token' => $refreshToken,
			],
			'message' => 'Refresh access token successful',
		]);
		exit;
	}

	public function testSanctumReadPosts(\WP_REST_Request $request) {
		$posts = get_posts([
			'post_type'      => 'post',
			'posts_per_page' => 10,
		]);

		return [
			'posts' => array_map(function($post) {
				return [
					'id'      => $post->ID,
					'title'   => $post->post_title,
					'content' => $post->post_content,
					'date'    => $post->post_date,
				];
			}, $posts),
		];
	}

}