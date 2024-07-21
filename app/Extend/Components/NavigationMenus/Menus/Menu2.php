<?php

namespace WPSP\app\Extend\Components\NavigationMenus\Menus;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseNavigationMenu;

class Menu2 extends BaseNavigationMenu {

	use InstancesTrait;

	// Args.
	public $menu                 = 'menu-2';
//	public $menu_class           = '';
//	public $menu_id              = '';            // The "id" attribute of the <ul> element.
//	public $container            = '';
//	public $container_class      = '';
//	public $container_id         = '';
//	public $container_aria_label = '';
//	public $fallback_cb          = false;
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

	public function customProperties(): void {
//		$this->args->menu        = 'menu-2';
//		$this->args->fallback_cb = $this->fallback();
	}

	public function fallback(): \Closure {
		return function () {
			return 'Menu 2 fallback...';
		};
	}

}