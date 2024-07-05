<?php

namespace WPSP\app\Extend\Components\NavigationMenus\Menus;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseNavigationMenu;

class Menu1 extends BaseNavigationMenu {

	use InstancesTrait;

	// Args.
//	public mixed $menu                 = 'menu-1';
//	public mixed $menu_class           = '';
//	public mixed $menu_id              = '';            // The "id" attribute of the <ul> element.
//	public mixed $container            = '';
//	public mixed $container_class      = '';
//	public mixed $container_id         = '';
//	public mixed $container_aria_label = '';
//	public mixed $fallback_cb          = false;
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
//		$this->args->menu        = 'menu-1';
		$this->args->fallback_cb = $this->fallback();
	}

	public function fallback(): \Closure {
		return function () {
			return 'Menu 1 fallback...';
		};
	}

}