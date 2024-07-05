<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSP\app\Extend\Components\NavigationMenus\nav_primary;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShortcode;

class custom_shortcode extends BaseShortcode {

	use InstancesTrait;

	public function init($atts, $content, $tag) {
		nav_primary::get();
//		return Funcs::view('modules.web.shortcodes.custom_shortcode')->render();
	}

}