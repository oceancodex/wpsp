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

class wpsp_child_post_type_wpsp_content extends BaseAdminPage {

	use InstancesTrait;

	public $menu_title                  = 'WPSP Content';
//	public $page_title                  = 'wpsp_child_post_type_wpsp_content';
	public $capability                  = 'manage_options';
//	public $menu_slug                   = 'wpsp-child-post-type-wpsp-content';
	public $icon_url                    = 'dashicons-admin-generic';
//	public $position                    = 2;
	public $parent_slug                 = 'wpsp';
	public $is_submenu_page             = true;
//	public $remove_first_submenu        = false;
	public $urls_highlight_current_menu = ['post-new.php?post_type=wpsp_content'];
	public $callback_function           = null;

	public $screen_options              = null;
	public $screen_options_key          = null;

//	private $checkDatabase              = null;
	private $table                      = null;
	private $currentTab                 = null;
	private $currentPage                = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.wpsp_child_post_type_wpsp_content')) . ' - ' . Funcs::config('app.name');
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
		echo '<div class="wrap"><h1>Admin page: "wpsp_child_post_type_wpsp_content"</h1></div>';
	}

	public function update() {}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}