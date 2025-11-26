<?php

namespace WPSP\App\Components\Shortcodes;

use WPSP\App\Components\NavigationMenus\Menus\Menu1;
use WPSP\App\Components\NavigationMenus\Menus\Menu2;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Components\Shortcodes\BaseShortcode;

class custom_shortcode extends BaseShortcode {

	use InstancesTrait;

//	public $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag) {
		return Menu1::render() . Menu2::render();
//		return Funcs::view('modules.shortcodes.custom_shortcode', compact('content'))->render();
	}


	/*
	 *
	 */

	public function customProperties() {
//		$this->shortcode = 'custom_shortcode';
	}

}