<?php

namespace WPSP\App\WordPress\NavigationMenus\Menus;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\NavigationMenus\Menus\BaseNavigationMenu;

class Menu1 extends BaseNavigationMenu {

	use InstancesTrait;

	// Args.
	public $menu                 = 'menu-1';
//	public $menu_class           = '';
//	public $menu_id              = '';            // The "id" attribute of the <ul> element.
//	public $container            = '';
//	public $container_class      = '';
//	public $container_id         = '';
//	public $container_aria_label = '';
//	public $fallback_cb          = false;         // If the menu doesn’t exist, a callback function will fire.
//	public $before               = '';
//	public $after                = '';
//	public $link_before          = '';
//	public $link_after           = '';
//	public $echo                 = true;
//	public $depth                = 0;
//	public $walker               = null;
//	public $theme_location       = '';
//	public $items_wrap           = '';
//	public $item_spacing         = '';            // 'preserve' or 'discard'

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {}

	/*
	 *
	 */

	public function customProperties(Request $request) {
		$this->fallback_cb = $this->fallback();
	}

	/*
	 *
	 */

	public function render() {
		// Code here...

		return parent::renderNavMenu();
	}

	/*
	 *
	 */

	public function fallback() {
		return function () {
			return 'Menu 1 fallback...';
		};
	}

}