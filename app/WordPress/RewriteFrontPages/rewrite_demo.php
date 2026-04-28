<?php

namespace WPSP\App\WordPress\RewriteFrontPages;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Integration\RankmathSEO;
use WPSPCORE\App\WordPress\Integration\YoastSEO;
use WPSPCORE\App\WordPress\RewriteFrontPages\BaseRewriteFrontPage;

class rewrite_demo extends BaseRewriteFrontPage {

	use InstancesTrait;

//	public $path                     = null;
	public $rewriteIdent             = 'rewrite_demo';
	public $useTemplate              = true;
	public $rewriteFrontPageSlug     = 'rewrite-front-pages'; // Bạn cần tạo một "Page" với slug như đã khai báo ở đây.
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
		$this->seo();

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

	/*
	 *
	 */

	public function seo() {
		add_filter('yoast_seo_development_mode', '__return_true');

//		global $wp_query, $post;
//		echo '<pre>'; print_r($wp_query); echo '</pre>';

//		echo '<pre>'; print_r($this->request->query->all()); echo '</pre>';

//		$post->post_title = $this->rewriteIdent;
//		$post->post_content = 'Rewrite front page for path: ' . $this->path;

		$this->currentURL = home_url($this->request->getRequestUri());

		add_filter('wpseo_robots', function($robots, $presentation) {
			return 'index, follow';
		}, 10, 2);

		add_filter('wpseo_canonical', function($canonical) {
			return Funcs::route('RewriteFrontPages', 'rewrite-demo.index', null, true, false);
		});

//		add_filter('pre_get_document_title', function($title) {
//			return 'Rewrite front page for path: ' . $this->path;
//		}, 20);

		add_filter('wpseo_title', function($title) {
			return 'Rewrite front page for path: ' . $this->path;
		});

		add_filter('wpseo_metadesc', function($description) {
			return 'Rewrite front page for path: ' . $this->path;
		});

		add_filter('wpseo_opengraph_title', function($title) {
			return 'Rewrite front page for path: ' . $this->path;
		});

		add_filter('wpseo_opengraph_desc', function($description) {
			return 'Rewrite front page for path: ' . $this->path;
		});

		add_filter('wpseo_opengraph_url', function($url) {
			return Funcs::route('RewriteFrontPages', 'rewrite-demo.index', null, true, false);
		});

		add_filter('wpseo_schema_breadcrumb', function($entity) {
			$entity['@id'] = $this->currentURL . '#breadcrumb';
			$entity['itemListElement'][1] = [
				'@type' => 'ListItem',
				'position' => 2,
				'name' => 'Rewrite front page for path: ' . $this->path,
				'item' => Funcs::route('RewriteFrontPages', 'rewrite-demo.index', null, true, false),
			];
			$entity['itemListElement'][2] = [
				'@type' => 'ListItem',
				'position' => 3,
				'name' => 'Rewrite front page for path: ' . $this->path,
				'item' => $this->currentURL,
			];
			return $entity;
		});

		add_filter('wpseo_schema_webpage', function($data, $context) {
			$data['@id']                          = $this->currentURL;
			$data['url']                          = $this->currentURL;
			$data['name']                         = 'Rewrite front page for path: ' . $this->path;
			$data['breadcrumb']['@id']            = $this->currentURL . '#breadcrumb';
			$data['datePublished']                = Carbon::now()->format('Y-m-d\TH:i:sP');
			$data['dateModified']                 = Carbon::now()->format('Y-m-d\TH:i:sP');
			$data['potentialAction'][0]['target'] = [$this->currentURL];
			return $data;
		}, 10, 2);

//		add_filter('wpseo_opengraph_image', function($image) {
//			$image = wp_get_attachment_image_src(14)[0];
//			return $image;
//		});

		add_filter('wpseo_add_opengraph_images', function($image_container) {
			$image_container->add_image_by_id(14);
		});

		add_filter('wpseo_add_opengraph_additional_images', function($image_container) {
			$image_id = 15;
			$image_container->add_image_by_id($image_id);
		});
	}

}