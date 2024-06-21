<?php
namespace OCBP\routes;

use OCBPCORE\Base\BaseRoute;
use OCBP\app\Components\AdminPages\ocbp as AdminPage_ocbp;
use OCBP\app\Components\PostTypes\ocbp_content as PostType_ocbp_content;
use OCBP\app\Components\RewriteFrontPages\ocbp as RewriteFrontPage_ocbp;
use OCBP\app\Components\RewriteFrontPages\ocbp_with_template as RewriteFrontPage_ocbp_with_template;
use OCBP\app\Components\MetaBoxes\ocbp_content as MetaBox_ocbp_content;
use OCBP\app\Components\Shortcodes\ocbp_content as Shortcode_ocbp_content;
use OCBP\app\Components\Templates\ocbp_without_header_footer as Template_ocbp_without_header_footer;
use OCBP\app\Components\Templates\ocbp_without_title as Template_ocbp_without_title;
use OCBP\app\Components\Templates\ocbp_center_content as Template_ocbp_center_content;
use OCBP\app\Http\Middleware\AdministratorCapability;
use OCBP\app\Http\Middleware\EditorCapability;
use OCBPCORE\Traits\WebRouteTrait;
use OCBP\app\Components\Shortcodes\rewrite_front_page_content as Shortcode_rewrite_front_page_content;
use OCBP\app\Components\Templates\ocbp_right_content as Template_ocbp_right_content;
use OCBP\app\Components\Templates\ocbp_bigger_content_font_size as Template_ocbp_bigger_content_font_size;
use OCBP\app\Components\Taxonomies\ocbp_category as Taxonomy_ocbp_category;
use OCBP\app\Components\Shortcodes\custom_shortcode as Shortcode_custom_shortcode;

class WebRoute extends BaseRoute {

	use WebRouteTrait;

	public function apis(): void {
		$this->admin_pages();
		$this->rewrite_front_pages();
	}

	public function admin_pages(): void {
		$this->get('ocbp', [AdminPage_ocbp::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->post('ocbp', [AdminPage_ocbp::class, 'update'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	public function rewrite_front_pages(): void {
		$this->get('ocbp\/([^\/]+)\/?$', [RewriteFrontPage_ocbp::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->get('ocbp-with-template\/?$', [RewriteFrontPage_ocbp_with_template::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function templates(): void {
		$this->template('ocbp-without-title', [Template_ocbp_without_title::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('ocbp-center-content', [Template_ocbp_center_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('ocbp-without-header-footer', [Template_ocbp_without_header_footer::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('ocbp-right-content', [Template_ocbp_right_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('ocbp-bigger-content-font-size', [Template_ocbp_bigger_content_font_size::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	public function meta_boxes(): void {
		$this->meta_box('ocbp_shortcode', [MetaBox_ocbp_content::class, 'init'], true, null, [
			[AdministratorCapability::class, 'handle'],
		]);
	}

	public function shortcodes(): void {
		$this->shortcode('ocbp_content', [Shortcode_ocbp_content::class, 'init'], true, null, [
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
		$this->post_type('ocbp', [PostType_ocbp_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
	}

	public function taxonomies(): void {
		$this->taxonomy('ocbp_category', [Taxonomy_ocbp_category::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

	public function hooks(): void {}

}