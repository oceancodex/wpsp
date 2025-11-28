<?php

namespace WPSP\App\WP\RewriteFrontPages;

use Illuminate\Http\Request;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\WP\Integration\RankmathSEO;
use WPSPCORE\WP\Integration\YoastSEO;
use WPSPCORE\WP\RewriteFrontPages\BaseRewriteFrontPage;

class wpsp extends BaseRewriteFrontPage {

	use InstancesTrait;

//	public $path                     = null;
	public $rewriteIdent             = 'wpsp';
	public $useTemplate              = false;
	public $rewriteFrontPageSlug     = 'rewrite-front-pages'; // You need create a "Page" with the slug like this.
	public $rewriteFrontPagePostType = 'page';

	/**
	 * Private properties.
	 */

	private $currentURL     = null;
	private $queryVarGroup1 = null;
	private $seo            = null;

	/*
	 *
	 */

	public function customProperties() {
//		$this->path = 'WPSP\App\/([^\/]+)\/?$';
	}

	/*
	 *
	 */

	public function index(Request $request, $endpoint = null) {
//		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($endpoint); echo '</pre>';

		// Test dispatch - Thêm try-catch để bắt lỗi
//		try {
//			$queue = Funcs::queue();
//			if ($queue) {
				// Test job đơn.
//				dispatch((new FailingJob('test@example.com'))->onQueue('test'));
//				dispatch((new SendEmailJob('test1@example.com'))->onQueue('test1'));

				// Test nhóm jobs.
//				Queue::batch([
//					new SendEmailJob(['email' => 'test1@example.com']),
//					new FailingJob(['email' => 'test2@example.com']),
//				], 'Test Batch')
//					->then(function($b) {
//						Logger::log('Batch done: ' . $b->id);
//					})
//					->catch(function($b, $e) {
//						Logger::log('[X] Batch error: ' . $e->getMessage());
//					})
//					->dispatch();

				// Test nhóm jobs.
//				Queue::batch([
//					new SendEmailJob('test2@example.com'),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//				], 'Test Batch')
//					->onQueue('test1')
//					->then(function($b) {
//						Log::log('Batch done: ' . $b->id);
//					})
//					->catch(function($b, $e) {
//						Log::log('[X] Batch error: ' . $e->getMessage());
//					})
//					->dispatch();

				// Test nhóm jobs.
//				Queue::batch([
//					new SendEmailJob('test2@example.com'),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//					(new FailingJob('test3@example.com')),
//				], 'Test Batch')
//					->onConnection('database')
//					->onQueue('test2')
//					->then(function($b) {
//						Log::log('Batch done: ' . $b->id);
//					})
//					->catch(function($b, $e) {
//						Log::log('[X] Batch error: ' . $e->getMessage());
//					})
//					->dispatch();
//			}
//			else {
//				Log::log(null, 'Queue instance is null');
//			}
//		}
//		catch (\Throwable $e) {
//			Log::log('Failed to dispatch job: ' . $e->getMessage());
//			Log::log('Stack trace: ' . $e->getTraceAsString());
//		}

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
//		echo Funcs::view('modules.rewrite-front-pages.wpsp')->render();
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

//		add_filter('yoast_seo_development_mode', '__return_true');

		$this->currentURL     = home_url($this->request->getRequestUri());
		$this->queryVarGroup1 = get_query_var(Funcs::config('app.short_name') . '_rewrite_group_1') ?: $this->rewriteIdent;

		$this->seo = new YoastSEO();
//		$this->seo = new RankmathSEO();

		/**
		 * Normal meta tags.
		 */
		$this->seo->setRobots(['index, follow']);
		$this->seo->setCanonical($this->currentURL);
		$this->seo->setTitle($this->queryVarGroup1);
		$this->seo->setDocumentTitle($this->queryVarGroup1);
		$this->seo->setDescription('Rewrite front page "wpsp" custom SEO description.');

		/**
		 * Facebook Open Graph meta data.
		 */
		$this->seo->setOpengraphURL($this->currentURL);
		$this->seo->setOpengraphTitle($this->queryVarGroup1);
		$this->seo->setOpengraphDescription('Rewrite front page "wpsp" custom SEO description.');

		/**
		 * Schemas.
		 */
		$this->seo->setSchema([$this, 'schema'], 10, 2);
		$this->seo->setSchemaWebpage([$this, 'schemaWebpage'], 10, 2);
		$this->seo->setSchemaBreadcrumb([$this, 'schemaBreadcrumb'], 10, 1);

		$this->seo->apply();
	}

	/*
	 *
	 */

	public function schema($data, $context) {
		return $data;
	}

	public function schemaWebpage($data, $context) {
		$data['@id']                          = $this->currentURL;
		$data['url']                          = $this->currentURL;
		$data['name']                         = $this->queryVarGroup1;
		$data['breadcrumb']['@id']            = $this->currentURL . '#breadcrumb';
		$data['potentialAction'][0]['target'] = [$this->currentURL];
		return $data;
	}

	public function schemaBreadcrumb($entity) {
		$entity['@id'] = $this->currentURL . '#breadcrumb';

		if ($this->seo instanceof RankmathSEO) {
			$entity['itemListElement'][1]['item']['@id'] = $this->currentURL;
			$entity['itemListElement'][1]['item']['name'] = $this->queryVarGroup1;
		}
		elseif ($this->seo instanceof YoastSEO) {
			$entity['itemListElement'][1]['name'] = $this->queryVarGroup1;
		}

		return $entity;
	}

}