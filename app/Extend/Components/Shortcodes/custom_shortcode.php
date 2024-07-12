<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSP\app\Extend\Components\NavigationMenus\Menus\Menu1;
use WPSP\app\Extend\Components\NavigationMenus\Menus\Menu2;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShortcode;

class custom_shortcode extends BaseShortcode {

	use InstancesTrait;

	public function index($atts, $content, $tag): string {
		return Menu1::render() . Menu2::render();
//		return Funcs::view('modules.web.shortcodes.custom_shortcode')->render();
	}

}