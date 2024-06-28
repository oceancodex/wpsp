<?php
namespace WPSP\routes;

use WPSP\app\Extend\Components\AdminPages\wpsp as AdminPage_wpsp;
use WPSP\app\Extend\Components\MetaBoxes\wpsp_content as MetaBox_wpsp_content;
use WPSP\app\Extend\Components\PostTypes\wpsp_content as PostType_wpsp_content;
use WPSP\app\Extend\Components\RewriteFrontPages\wpsp as RewriteFrontPage_wpsp;
use WPSP\app\Extend\Components\RewriteFrontPages\wpsp_with_template as RewriteFrontPage_wpsp_with_template;
use WPSP\app\Extend\Components\Shortcodes\custom_shortcode as Shortcode_custom_shortcode;
use WPSP\app\Extend\Components\Shortcodes\rewrite_front_page_content as Shortcode_rewrite_front_page_content;
use WPSP\app\Extend\Components\Shortcodes\wpsp_content as Shortcode_wpsp_content;
use WPSP\app\Extend\Components\Taxonomies\wpsp_category as Taxonomy_wpsp_category;
use WPSP\app\Extend\Components\Templates\wpsp_bigger_content_font_size as Template_wpsp_bigger_content_font_size;
use WPSP\app\Extend\Components\Templates\wpsp_center_content as Template_wpsp_center_content;
use WPSP\app\Extend\Components\Templates\wpsp_right_content as Template_wpsp_right_content;
use WPSP\app\Extend\Components\Templates\wpsp_without_header_footer as Template_wpsp_without_header_footer;
use WPSP\app\Extend\Components\Templates\wpsp_without_title as Template_wpsp_without_title;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\WebRouteTrait;

class WebRoute extends BaseRoute {

	use WebRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function apis(): void {
		$this->admin_pages();
		$this->rewrite_front_pages();
	}

	public function admin_pages(): void {
		$this->get('wpsp', [AdminPage_wpsp::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->post('wpsp', [AdminPage_wpsp::class, 'update'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	public function rewrite_front_pages(): void {
		$this->get('wpsp\/([^\/]+)\/?$', [RewriteFrontPage_wpsp::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->post('wpsp\/([^\/]+)\/?$', [RewriteFrontPage_wpsp::class, 'update'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->get('wpsp-with-template\/?$', [RewriteFrontPage_wpsp_with_template::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function templates(): void {
		$this->template('wpsp-without-title', [Template_wpsp_without_title::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-center-content', [Template_wpsp_center_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-without-header-footer', [Template_wpsp_without_header_footer::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-right-content', [Template_wpsp_right_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-bigger-content-font-size', [Template_wpsp_bigger_content_font_size::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	public function meta_boxes(): void {
		$this->meta_box('wpsp_shortcode', [MetaBox_wpsp_content::class, 'init'], true, null, [
			[AdministratorCapability::class, 'handle'],
		]);
	}

	public function shortcodes(): void {
		$this->shortcode('wpsp_content', [Shortcode_wpsp_content::class, 'init'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
		$this->shortcode('rewrite_front_page_content', [Shortcode_rewrite_front_page_content::class, 'init'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
		$this->shortcode('custom_shortcode', [Shortcode_custom_shortcode::class, 'init'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
	}

	public function post_types(): void {
		$this->post_type('wpsp', [PostType_wpsp_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
	}

	public function taxonomies(): void {
		$this->taxonomy('wpsp_category', [Taxonomy_wpsp_category::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function hooks(): void {}

	public function actions(): void {}

	public function filters(): void {}

}