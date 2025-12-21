<?php

namespace WPSP\App\WordPress\Shortcodes;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\WordPress\NavigationMenus\Menus\Menu1;
use WPSP\App\WordPress\NavigationMenus\Menus\Menu2;
use WPSPCORE\App\WordPress\Shortcodes\BaseShortcode;

class custom_shortcode extends BaseShortcode {

	use InstancesTrait;

//	public $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag) {
		return Menu1::render() . Menu2::render();
//		return Funcs::view('shortcodes.custom_shortcode', compact('content'))->render();
	}


	/*
	 *
	 */

	public function customProperties() {
//		$this->shortcode = 'custom_shortcode';
	}

}