<?php

namespace WPSP\app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Http\Requests\UsersUpdateRequest;
use WPSP\app\Models\PersonalAccessTokensModel;
use WPSP\app\Models\UsersModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApisController extends BaseController {

	use InstancesTrait;

	public function wpsp(\WP_REST_Request $request) {

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
			// Test HttpException.
//			throw new \WPSP\app\Exceptions\HttpException(
//				429,
//				'Bạn đã gửi quá nhiều request. Vui lòng thử lại sau.',
//				['Retry-After' => 60]
//			);

			return Funcs::response(
				false,
				[
					'rate_limit_remaining' => $rateLimitByIpRemaining
				],
				'Rate limit exceeded. Please try again later.',
				429
			);
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
			$password = ($_POST['password'] ?? '');
			$redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : (wp_get_referer() ?? $this->request->getRequestUri());

			// Check missing parameters.
			if (!$login || !$password) {
				if (Funcs::wantJson()) {
					wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'missing'], $redirect));
				}
				exit;
			}

//			$auth = wpsp_auth('api')->attempt(['login' => $login, 'password' => $password]);
//			$user = $auth->user();
//			echo '<pre>'; print_r($user->toArray()); echo '</pre>';
//			$roles = $user->roles_and_permissions;
//			echo '<pre>'; print_r($roles); echo '</pre>'; die();

			// Login attempt and fire an action if login failed.
			if (!wpsp_auth('web')->attempt(['login' => $login, 'password' => $password])) {
				if (Funcs::wantJson()) {
					wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'failed'], $redirect));
				}
				exit;
			}

			// if (!empty($_POST['remember'])) { ... }

			// Redirect after login success.
			if (Funcs::wantJson()) {
				wp_send_json([
					'success' => true,
					'data'    => [
						'user' => wpsp_auth('web')->user()->toArray(),
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
			if (Funcs::wantJson()) {
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
		if (Funcs::wantJson()) {
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
		$refresh  = $request->get_param('refresh');

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
				'user'      => $user->toArray(),
			],
			'message' => 'API token retrieved',
		]);

	}

	public function testApiToken(\WP_REST_Request $request) {
		wp_send_json([
			'success' => true,
			'data'    => [
//				'user' => wpsp_auth('api')->user()->toArray(),
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

	public function usersUpdate(\WP_REST_Request $request) {
		// Lấy ID từ request: "/wp-json/wpsp/v1/users/(?P<id>\d+)/update"
		$id = $request->get_param('id');

		// Lấy user hiện tại.
		$user = Auth::instance()->guard('web')->user() ?? null;

		// Khởi tạo form request để validate dữ liệu.
		$formRequest = new UsersUpdateRequest();

		// Đặt "input_user_id" để đảm bảo 2 việc:
		// 1. User hiện tại giữ nguyên "email" thì vẫn validate thành công.
		// 2. User hiện tại không thể đổi "email" thành email của một người khác.
		$formRequest->input_user_id = $id;

		// Truyền thêm "authUser" vào form request.
		$formRequest->authUser = $user;

		// Validate dữ liệu.
		$formRequest->validated();

		// Nếu có user, thực hiện update.
		if ($user && ($user->ID == $id || $user->id == $id)) {
			$user->update($request->get_params());
			$user = wpsp_auth()->user() ?? null;
			wp_send_json([
				'success' => true,
				'data'    => [
					'user' => $user,
				],
				'message' => 'User updated',
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
		$token = PersonalAccessTokensModel::query()->where('refresh_token', hash('sha256', $refreshToken))->first();

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

	/*
	 *
	 */

	public function validationParamsDirectTest(\WP_REST_Request $request) {

		// Sử dụng validation của class hiện tại.
		$this->validation->validate($request->get_params(), [
		    'username' => 'required|string|max:255|unique:cm_users,username',
			'email'    => 'required|email',
		]);

		// Sử dụng validation của $request.
//		$this->request->validate([
//			'username' => 'required|string|max:255|unique:cm_users,username',
//			'email'    => 'required|email',
//		]);

		wp_send_json([
			'success' => true,
			'data'    => $request->get_params(),
			'message' => 'Validation successful',
		]);
	}

	public function validationParamsFormRequestTest(\WP_REST_Request $request) {
		// Validate dữ liệu qua FormRequest.
		$request = new UsersUpdateRequest();
		$request->validated();

		wp_send_json([
			'success' => true,
			'data'    => $request->all(),
			'message' => 'Validation successful',
		]);
	}

}