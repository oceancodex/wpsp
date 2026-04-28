<?php

namespace WPSP\App\WordPress\RewriteFrontPages;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Integration\RankmathSEO;
use WPSPCORE\App\WordPress\Integration\YoastSEO;
use WPSPCORE\App\WordPress\RewriteFrontPages\BaseRewriteFrontPage;

class wpsp extends BaseRewriteFrontPage {

	use InstancesTrait;

//	public $path                     = null;
	public $rewriteIdent             = 'wpsp';
	public $useTemplate              = false;
	public $rewriteFrontPageSlug     = 'rewrite-front-pages'; // Bạn cần tạo một "Page" với slug như đã khai báo ở đây.
	public $rewriteFrontPagePostType = 'page';

	/**
	 * Private properties.
	 */

	private $currentURL     = null;
	private $queryVarGroup1 = null;

	/*
	 *
	 */

	public function customProperties() {
//		$this->path = 'wpsp\/([^\/]+)\/?$';
	}

	/*
	 *
	 */

	public function index(Request $request, $endpoint = null) {
//		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($this->request->route('slug2')); echo '</pre>';
//		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($endpoint); echo '</pre>';

//		global $wp_query, $post;
//		echo '<pre>'; print_r($wp_query); echo '</pre>';
//		$this->seo();

//		echo '<pre>'; print_r(Funcs::auth()->user()); echo '</pre>';
//		echo '<pre>'; print_r(Auth::check()); echo '</pre>';

//		$user = Funcs::auth('web')->user();
//		$user->guard_name = 'api';
//		$user->givePermissionTo('api_edit_articles');

//		if (Funcs::auth('api')->user() !== null && Funcs::auth('api')->user()->can('api_edit_articles')) {
//			echo 'User can "api_edit_articles".<br/><br/>';
//		}

		echo 'Rewrite front page for path: ' . $this->path . '<br/><br/>';

//		remove_shortcode('rewrite_front_page_content');
//		echo Funcs::view('rewrite-front-pages.wpsp')->render();
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