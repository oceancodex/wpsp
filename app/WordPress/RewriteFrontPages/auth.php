<?php

namespace WPSP\App\WordPress\RewriteFrontPages;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Notifications\UsersVerifyEmailNotification;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Integration\RankmathSEO;
use WPSPCORE\App\WordPress\Integration\YoastSEO;
use WPSPCORE\App\WordPress\RewriteFrontPages\BaseRewriteFrontPage;

class auth extends BaseRewriteFrontPage {

	use InstancesTrait;

//	public $path                     = null;
	public $rewriteIdent             = 'auth';
	public $useTemplate              = false;
//	public $rewriteFrontPageSlug     = 'rewrite-front-pages'; // Bạn cần tạo một "Page" với slug như đã khai báo ở đây.
//	public $rewriteFrontPagePostType = 'page';

	/**
	 * Private properties.
	 */

	private $currentURL     = null;
	private $queryVarGroup1 = null;

	/*
	 *
	 */

	public function customProperties() {
//		$this->path = 'auth\/([^\/]+)\/?$';
	}

	/*
	 *
	 */

	public function login(Request $request) {
		@http_response_code(200);
		echo Funcs::view('auth.login');
		exit;
	}

	public function register(Request $request) {
		echo Funcs::view('auth.register');
		exit;
	}

	public function resend(Request $request) {
		try {
			if ($request->user()) {
				$request->user()?->notify(new UsersVerifyEmailNotification());
				wp_redirect(Funcs::route('RewriteFrontPages', 'verification.notice', ['resend' => true], true));
			}
			else {
				wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
			}
		}
		catch (\Exception $e) {
			echo $e->getMessage();
		}
		exit;
	}

	public function notice(Request $request) {
		@http_response_code(200);
		$resend = $request->get('resend') ?? false;
		echo view('auth.verify-email', compact('resend'));
		exit;
	}

	public function verify(EmailVerificationRequest $request) {
		$request->fulfill();
		wp_redirect('/wp-admin');
		exit;
	}

	public function forgotPassword(Request $request) {
		echo Funcs::view('auth.forgot-password');
		exit;
	}

	public function resetPassword(Request $request) {
		$token = $request->route('token');
		$token = Str::before($token, '?email=');
		echo Funcs::view('auth.reset-password', [
			'email' => $request->get('email') ?? '',
			'token' => $token ?? '',
		]);
		exit;
	}

	public function update($path = null) {
//		global $wp_query, $post;
//		echo '<pre>'; print_r($wp_query); echo '</pre>';
		echo '<pre>'; print_r($this->request->request->all()); echo '</pre>';
	}

	/*
	 *
	 */

	public function seo() {
//		global $wp_query, $post;
//		echo '<pre>'; print_r($wp_query); echo '</pre>';

//		echo '<pre>'; print_r($this->request->query->all()); echo '</pre>';

//		$post->post_title = $this->rewriteIdent;
//		$post->post_content = 'Rewrite front page for path: ' . $this->path;

//		add_filter('yoast_seo_development_mode', '__return_true');
	}

}