<?php

namespace WPSP\App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use WPSP\App\Events\UsersRegisteredEvent;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\App\Widen\Support\Facades\Event;
use WPSP\App\Widen\Support\Facades\Password;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Http\Requests\UsersCreateRequest;
use WPSP\App\Http\Requests\UsersUpdateRequest;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;
use WPSPCORE\App\Http\Controllers\BaseController;

class ApisController extends BaseController {

	use InstancesTrait;

	public function wpsp(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {

		// Rate limit for 10 requests per 30 seconds based on the user display name or request IP address.
		try {
			$rateLimitKey           = 'api_wpsp_' . (wp_get_current_user()->display_name ?? $this->request->getClientIp());
			$rateLimitByIp          = RateLimiter::get('api', $rateLimitKey)->consume();
			$rateLimitByIpRemaining = $rateLimitByIp->getRemainingTokens();
			$rateLimitByIpAccepted  = $rateLimitByIp->isAccepted();
		}
		catch (\Throwable $e) {
			$rateLimitByIpAccepted  = true;
			$rateLimitByIpRemaining = null;
		}

		if (false === $rateLimitByIpAccepted) {
			// Test HttpException.
//			throw new \WPSP\App\Exceptions\HttpException(
//				429,
//				'Bạn đã gửi quá nhiều request. Vui lòng thử lại sau.',
//				['Retry-After' => 60]
//			);

			return Funcs::response(
				false,
				[
					'rate_limit_remaining' => $rateLimitByIpRemaining,
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

	public function getApiToken(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		$login    = sanitize_text_field($wpRestRequest->get_param('login'));
		$password = $wpRestRequest->get_param('password');
		$refresh  = $wpRestRequest->get_param('refresh');

		if (!$login || !$password) {
			wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
		}

		$auth = Funcs::auth()->attempt(['name' => $login, 'password' => $password]);

		if (!$auth) {
			wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
		}

		/** @var UsersModel $user */
		$user = Funcs::auth()->user();
		$token = Str::random(64);
		if (($user && $refresh) || !$user->api_token) {
			$user->api_token = hash('sha256', $token);
			$user->save();
		}

		wp_send_json([
			'success' => true,
			'data'    => [
				'api_token' => $token,
				'user'      => $user->toArray(),
			],
			'message' => 'API token retrieved',
		]);

	}

	public function testApiToken(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		wp_send_json([
			'success' => true,
			'data'    => [
//				'user' => Funcs::auth('api')->user()->toArray(),
				'parameters' => $wpRestRequest->get_params(),
			],
			'message' => 'API token retrieved',
		]);
	}

	/*
	 *
	 */

	public function wpRestNonce(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		$nonce = wp_create_nonce('wp_rest');
		wp_send_json([
			'success' => true,
			'data'    => [
				'nonce' => $nonce,
			],
			'message' => 'Nonce retrieved',
		]);
	}

	public function register(\WP_REST_Request $wpRestRequest, UsersCreateRequest $request, $path, $fullPath, $requestPath) {
		$data = $request->only(['name','email']);
		$data['password'] = Hash::make($request->password);

		// Create user
		$user = UsersModel::create($data);

		// Fire Registered event — useful if bạn dùng email verification / listeners
		Event::dispatch(new UsersRegisteredEvent($user));

		// Login user (optional)
		Auth::login($user);

		// Redirect to intended or home
		wp_redirect(Funcs::route('RewriteFrontPages', 'wpsp.index', ['endpoint' => 'abc'], true));
		exit;
	}

	public function login(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
//		try {
			// Lấy nonce từ request Rest API.
			$action = 'wp_rest';
			$nonce  = $wpRestRequest->get_param('_wpnonce');

			if (!$nonce || !wp_verify_nonce($nonce, $action)) {
				return new \WP_REST_Response([
					'success' => false,
					'message' => 'Invalid nonce.',
				], 403);
			}

			// Get parameters.
			$login    = sanitize_text_field($_POST['login'] ?? '');
			$password = ($_POST['password'] ?? '');
			$remember = isset($_POST['remember']) && $_POST['remember'];
			$redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : (wp_get_referer() ?? $this->request->getRequestUri());
			if ($redirect == '/auth/login') {
				$redirect = Funcs::route('AdminPages', 'wpsp.index', true);
			}

			// Check missing parameters.
			if (!$login || !$password) {
				if (Funcs::wantsJson()) {
					wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'missing'], $redirect));
				}
				exit;
			}

			// Login attempt via "email" or "name" and fire an action if login failed.
			$field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
			if (!Funcs::auth()->attempt([$field => $login, 'password' => $password], $remember)) {
				if (Funcs::wantsJson()) {
					wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 422);
				}
				else {
					wp_safe_redirect(add_query_arg(['auth' => 'failed'], $redirect));
				}
				exit;
			}

			// if (!empty($_POST['remember'])) { ... }

			// Redirect after login success.
			if (Funcs::wantsJson()) {
				wp_send_json([
					'success' => true,
					'data'    => [
						'user' => Funcs::auth()->user()->toArray(),
					],
					'message' => 'Login successful',
				]);
			}
			else {
				wp_safe_redirect($redirect);
			}
			exit;
//		}
//		catch (\Throwable $e) {
//			if (Funcs::wantsJson()) {
//				wp_send_json(['success' => false, 'message' => $e->getMessage()], 500);
//			}
//			else {
//				wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
//			}
//			exit;
//		}
	}

	public function logout(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		Funcs::auth()->logout();

		$session = Funcs::app('session');
		$clientSession = $_COOKIE['wpsp-session'] ?? null;
		if ($clientSession) {
			$session->setId($clientSession);
			$session->save();
		}

		if (Funcs::wantsJson()) {
			wp_send_json([
				'success' => true,
				'data'    => null,
				'message' => 'Logout successful',
			]);
		}
		wp_safe_redirect(wp_get_referer() ?: $this->request->getRequestUri());
		exit;
	}

	public function testKeepLogin(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		$user = Funcs::auth('web')->user() ?? null;
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

	public function forgotPassword(\WP_REST_Request $wpRestRequest, Request $request, $path, $fullPath, $requestPath) {
		header('Content-Type: text/html; charset=utf-8');

		$request->validate(['email' => 'required|email']);

		// Send reset password link to the given user's email.
		$status = Password::sendResetLink(
			$request->only('email')
		);

		if ($status === Password::ResetLinkSent) {
			wp_redirect(Funcs::route('AdminPages', 'wpsp.dashboard', ['success' => 'reset-link-sent'], true));
		}
		else {
			wp_redirect(Funcs::route('AdminPages', 'wpsp.dashboard', true));
		}

		exit;
	}

	public function resetPassword(Request $request) {
		header('Content-Type: text/html; charset=utf-8');

		$request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
		]);

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (UsersModel $user, string $password) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		if ($status === Password::PasswordReset) {
			wp_redirect(Funcs::route('AdminPages', 'wpsp.dashboard', ['success' => 'changed-password'], true));
		}
		else {
			wp_redirect(Funcs::route('AdminPages', 'wpsp.dashboard', ['success' =>  $status], true));
		}

		exit;
	}

	/*
	 *
	 */

	public function usersUpdate(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath, $id) {
		// Lấy ID từ request: "/wp-json/wpsp/v1/users/(?P<id>\d+)/update"
//		$id = $wpRestRequest->get_param('id');

		// Lấy user hiện tại.
		$user = Auth::instance()->guard('web')->user() ?? null;

		// Khởi tạo form request để validate dữ liệu.
		$app = Funcs::app();
		$req = UsersUpdateRequest::createFrom($app['request']);
		$req->setContainer($app);
		$req->setRedirector($app->make('redirect'));

		// Đặt "input_user_id" để đảm bảo 2 việc:
		// 1. User hiện tại giữ nguyên "email" thì vẫn validate thành công.
		// 2. User hiện tại không thể đổi "email" thành email của một người khác.
		$req->input_user_id = $id;

		// Truyền thêm "authUser" vào form request.
		$req->authUser = $user;

		// Validate dữ liệu.
		$req->validateResolved();
		$req->validated();

		// Nếu có user, thực hiện update.
		if ($user && ($user->ID == $id || $user->id == $id)) {
			$user->update($wpRestRequest->get_params());

			$user = Funcs::auth()->user() ?? null;

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

	public function sanctumGenerateAccessToken(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
		/** @var UsersModel $user */
		$user = Funcs::auth()->user();

//		if ($user) {
			try {
				// Create token with specific abilities
				$tokenName = 'api-token';
				$token    = $user->createToken($tokenName, [
					'read:posts',
					'create:posts',
					'edit:posts',
				], Carbon::now()->addYear());

				if ($token) {
					return [
						'success' => true,
						'data'    => [
							'name'          => $tokenName,
							'token_type'    => 'Bearer',
							'access_token'  => $token->plainTextToken,
							'expires_at'    => $token->accessToken->expires_at,
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
			catch (\Throwable $e) {
				return [
					'success' => false,
					'data'    => null,
					'message' => $e->getMessage(),
				];
			}
//		}

//		return ['success' => false, 'message' => 'Invalid credentials'];
	}

	public function sanctumRefreshAccessToken(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
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

	public function testSanctumReadPosts(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
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

	public function validationParamsDirectTest(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {

		// Sử dụng validation của class hiện tại.
		$this->validation->validate($wpRestRequest->get_params(), [
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
			'data'    => $wpRestRequest->get_params(),
			'message' => 'Validation successful',
		]);
	}

	public function validationParamsFormRequestTest(\WP_REST_Request $wpRestRequest, $path, $fullPath, $requestPath) {
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