<?php

namespace WPSP\app\Extras\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extras\Components\License\License;
use WPSP\app\Extras\Instances\Cache\Cache;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\View\Share;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_dashboard extends BaseAdminPage {

	public $menu_title                  = 'Tab: Dashboard';
//	public  $page_title                 = 'Tab: Dashboard';
	public $capability                  = 'manage_options';
//	public  $menu_slug                  = 'wpsp&tab=dashboard';
	public $icon_url                    = 'dashicons-admin-generic';
//	public  $position                   = 2;
	public $parent_slug                 = 'wpsp';
	public $is_submenu_page             = true;
//	public  $remove_first_submenu       = false;
//	public $urls_highlight_current_menu = null;
	public $custom_properties           = null;
	public $callback_function           = null;

//	private mixed $checkDatabase        = null;
//	private mixed $table                = null;
	private mixed $currentTab           = null;
	private mixed $currentPage          = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
		if (class_exists('\WPSPCORE\Translation\Translator')) {
			$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');
		}
		else {
			$pageTitle = $this->currentTab ?? 'Dashboard';
			$this->page_title = Funcs::trans(ucfirst($pageTitle), true);
		}
	}

	/*
	 *
	 */

//	public function init($path = null) {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//
//      // Your code here...
//	}

	public function beforeInit() {}

	public function afterInit() {}

	public function afterLoad($adminPage) {}

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index() {
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_dashboard"</h1></div>';
	}

	public function update() {}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}