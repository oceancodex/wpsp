<?php

namespace WPSP\app\Extras\Components\NavigationMenus\Menus;

use WPSPCORE\Base\BaseNavigationMenu;

class Menu2 extends BaseNavigationMenu {

	// Args.
	public mixed $menu                 = 'menu-2';
//	public mixed $menu_class           = '';
//	public mixed $menu_id              = '';            // The "id" attribute of the <ul> element.
//	public mixed $container            = '';
//	public mixed $container_class      = '';
//	public mixed $container_id         = '';
//	public mixed $container_aria_label = '';
//	public mixed $fallback_cb          = false;         // If the menu doesn’t exist, a callback function will fire.
//	public mixed $before               = '';
//	public mixed $after                = '';
//	public mixed $link_before          = '';
//	public mixed $link_after           = '';
//	public mixed $echo                 = true;
//	public mixed $depth                = 0;
//	public mixed $walker               = null;
//	public mixed $theme_location       = '';
//	public mixed $items_wrap           = '';
//	public mixed $item_spacing         = '';            // 'preserve' or 'discard'

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->args->menu        = 'menu-2';
		$this->args->fallback_cb = $this->fallback();
	}

	public function fallback(): \Closure {
		return function () {
			return 'Menu 2 fallback...';
		};
	}

}