<?php

namespace WPSP\routes;

use WPSP\App\Components\Shortcodes\custom_shortcode;
use WPSP\App\Components\Shortcodes\rewrite_front_page_content;
use WPSP\App\Components\Shortcodes\wpsp_content;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Shortcodes\ShortcodesRouteTrait;

class Shortcodes extends BaseRoute {

	use InstancesTrait, ShortcodesRouteTrait;

	public function shortcodes() {
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

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}