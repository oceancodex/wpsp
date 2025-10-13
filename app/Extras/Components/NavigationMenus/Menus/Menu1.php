<?php

namespace WPSP\app\Extras\Components\NavigationMenus\Menus;

use WPSPCORE\Base\BaseNavigationMenu;

class Menu1 extends BaseNavigationMenu {

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

	public function customProperties() {
//		$this->args->menu        = 'menu-1';
		$this->args->fallback_cb = $this->fallback();
	}

	public function fallback() {
		return function () {
			return 'Menu 1 fallback...';
		};
	}

}