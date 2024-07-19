<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\WebRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\AdminPages\wpsp as AdminPage_wpsp;
use WPSP\app\Extend\Components\MetaBoxes\wpsp_content as MetaBox_wpsp_content;
use WPSP\app\Extend\Components\NavigationMenus\Locations\nav_primary as NavigationLocation_nav_primary;
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
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_dashboard as AdminPage_wpsp_tab_dashboard;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_license as AdminPage_wpsp_tab_license;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_database as AdminPage_wpsp_tab_database;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_settings as AdminPage_wpsp_tab_settings;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_tools as AdminPage_wpsp_tab_tools;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_table as AdminPage_wpsp_tab_table;
use WPSP\app\Extend\Components\AdminPages\wpsp_child_example as AdminPage_wpsp_child_example;

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
		$this->group(function() {
			$this->get('wpsp', [AdminPage_wpsp::class, 'init'], true);
			$this->post('wpsp', [AdminPage_wpsp::class, 'update'], true);
			$this->get('wpsp&tab=dashboard', [AdminPage_wpsp_tab_dashboard::class, 'init'], true);
			$this->get('wpsp&tab=license', [AdminPage_wpsp_tab_license::class, 'init'], true);
			$this->get('wpsp&tab=database', [AdminPage_wpsp_tab_database::class, 'init'], true);
			$this->get('wpsp&tab=settings', [AdminPage_wpsp_tab_settings::class, 'init'], true);
			$this->get('wpsp&tab=tools', [AdminPage_wpsp_tab_tools::class, 'init'], true);
			$this->get('wpsp&tab=table', [AdminPage_wpsp_tab_table::class, 'init'], true);
			$this->get('wpsp_child_example', [AdminPage_wpsp_child_example::class, 'init'], true);
		}, [
			'relation' => 'OR',
			[AdministratorCapability::class, 'handle'],
			[EditorCapability::class, 'handle']
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

	public function nav_locations(): void {
		$this->nav_location('nav_primary', [NavigationLocation_nav_primary::class, 'init'], true, null, [
//			'relation' => 'OR',
//            [AdministratorCapability::class, 'handle'],
//            [EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function hooks(): void {}

	public function actions(): void {}

	public function filters(): void {}

}