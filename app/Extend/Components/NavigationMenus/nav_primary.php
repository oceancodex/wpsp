<?php

namespace WPSP\app\Extend\Components\NavigationMenus;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseNavigationMenu;

class nav_primary extends BaseNavigationMenu {

	use InstancesTrait;

//	public ?string $location           = null;
//	public ?string $description        = null;

	// Args.
//	public mixed $menu                 = '';
//	public mixed $menu_class           = '';
//	public mixed $menu_id              = '';
//	public mixed $container            = '';
//	public mixed $container_class      = '';
//	public mixed $container_id         = '';
//	public mixed $container_aria_label = '';
//	public mixed $fallback_cb          = false;
//	public mixed $before               = '';
//	public mixed $after                = '';
//	public mixed $link_before          = '';
//	public mixed $link_after           = '';
	public mixed $echo                 = true;
//	public mixed $depth                = 0;
//	public mixed $walker               = null;
//	public mixed $theme_location       = 'primary';
//	public mixed $items_wrap           = '';
//	public mixed $item_spacing         = '';            // 'preserve' or 'discard'

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->location    = 'nav_primary';
//		$this->description = 'Primary navigation menu';

		/**
		 * Args.
		 */
		$this->args->fallback_cb = [$this, 'fallback'];
	}

	public function fallback() {

	}

}