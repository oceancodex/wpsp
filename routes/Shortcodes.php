<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ShortcodesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\Shortcodes\custom_shortcode;
use WPSP\app\Extras\Components\Shortcodes\rewrite_front_page_content;
use WPSP\app\Extras\Components\Shortcodes\wpsp_content;

class Shortcodes extends BaseRoute {

	use ShortcodesRouteTrait;

	public function shortcodes(): void {
		$this->shortcode('wpsp_content', [wpsp_content::class, 'index'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
		$this->shortcode('rewrite_front_page_content', [rewrite_front_page_content::class, 'index'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
		$this->shortcode('custom_shortcode', [custom_shortcode::class, 'index'], true, null, [
//			[AdministratorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}