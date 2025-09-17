<?php

namespace WPSP\app\Extras\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extras\Components\License\License;
use WPSP\app\Extras\Instances\Cache\Cache;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\View\Share;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_settings extends BaseAdminPage {

	use InstancesTrait;

	public  $menu_title                  = 'Tab: Settings';
//	public  $page_title                  = 'Tab: Settings';
	public  $capability                  = 'manage_options';
//	public  $menu_slug                   = 'wpsp-settings';
	public  $icon_url                    = 'dashicons-admin-generic';
//	public  $position                    = 2;
	public  $parent_slug                 = 'wpsp';
	public  $is_submenu_page             = true;
//	public  $remove_first_submenu        = false;
//	public  $urls_highlight_current_menu = null;
	public  $custom_properties           = null;
	public  $callback_function           = null;

//	private $checkDatabase               = null;
	private $table                       = null;
	private $currentTab                  = null;
	private $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.settings')) . ' - ' . Funcs::config('app.name');
	}

	/*
	 *
	 */

//	public function init($path = null): void {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//
//      // Your code here...
//	}

	public function beforeInit(): void {}

	public function afterInit(): void {}

	public function afterLoad($adminPage): void {}

//	public function screenOptions($adminPage): void {}

	/*
	 *
	 */

	public function index(): void {
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_settings"</h1></div>';
	}

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}