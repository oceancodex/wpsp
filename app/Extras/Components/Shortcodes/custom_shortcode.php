<?php

namespace WPSP\app\Extras\Components\Shortcodes;

use WPSP\app\Extras\Components\NavigationMenus\Menus\Menu1;
use WPSP\app\Extras\Components\NavigationMenus\Menus\Menu2;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShortcode;

class custom_shortcode extends BaseShortcode {

//	public mixed $shortcode = null;

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

	public function customProperties(): void {
//		$this->shortcode = 'custom_shortcode';
	}

}