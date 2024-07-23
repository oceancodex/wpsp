<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ShortcodesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\Shortcodes\custom_shortcode as Shortcode_custom_shortcode;
use WPSP\app\Extend\Components\Shortcodes\rewrite_front_page_content as Shortcode_rewrite_front_page_content;
use WPSP\app\Extend\Components\Shortcodes\wpsp_content as Shortcode_wpsp_content;

class Shortcodes extends BaseRoute {

	use ShortcodesRouteTrait, InstancesTrait;

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

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}