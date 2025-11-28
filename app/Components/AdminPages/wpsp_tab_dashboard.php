<?php

namespace WPSP\App\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\App\Models\VideosModel;
use WPSP\App\Traits\InstancesTrait;
use WPSP\App\Workers\Cache\Cache;
use WPSP\App\Workers\Cache\RateLimiter;
use WPSP\Funcs;
use WPSPCORE\Components\AdminPages\BaseAdminPage;

class wpsp_tab_dashboard extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title                  = 'Tab: Dashboard';
//	public $page_title                  = 'Tab: Dashboard';
//	public $first_submenu_title         = null;
	public $capability                  = 'read';
//	public $menu_slug                   = 'wpsp&tab=dashboard';
	public $icon_url                    = 'dashicons-admin-generic';
//	public $position                    = 2;
	public $parent_slug                 = 'wpsp';
	public $is_submenu_page             = true;
//	public $remove_first_submenu        = false;
//	public $urls_highlight_current_menu = null;
	public $callback_function           = null;

	/**
	 * Parent properties.
	 */
	protected $screen_options           = null;
	protected $screen_options_key       = null;

	/**
	 * Custom properties.
	 */
//	private $checkDatabase              = null;
//	private $table                      = null;
	private $currentTab                 = null;
	private $currentPage                = null;

	/*
	 *
	 */

	public function customProperties() {

		// Highlight menu "Table" with type "published".
		$this->urls_highlight_current_menu = [
			'admin.php?page=wpsp',
		];

		$this->currentTab  = static::$request->get('tab');
		$this->currentPage = static::$request->get('page');
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

	public function afterLoadAdminPage($adminPage) {}

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