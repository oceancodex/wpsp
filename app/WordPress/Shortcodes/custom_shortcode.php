<?php

namespace WPSP\App\WordPress\Shortcodes;

use Illuminate\Http\Request;
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

	public function customProperties() {
//		$this->shortcode = 'custom_shortcode';
	}

	/*
	 *
	 */

	public function index($atts, $content, $tag, Request $request, Menu1 $menu1) {
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($this->request->route('endpoint') ?? null); echo '</pre>';
//		return Menu1::render() . Menu2::render();
		return $menu1->render();
//		return Funcs::view('shortcodes.custom_shortcode', compact('content'))->render();
	}

}