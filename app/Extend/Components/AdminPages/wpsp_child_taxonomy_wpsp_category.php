<?php

namespace WPSP\app\Extend\Components\AdminPages;

use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\RateLimiter\Storage\CacheStorage;
use WPSP\app\Extend\Components\License\License;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_child_taxonomy_wpsp_category extends BaseAdminPage {

	use InstancesTrait;

	public  $menu_title                  = 'WPSP Category';
//	public  $page_title                  = 'wpsp_child_taxonomy_wpsp_category';
	public  $capability                  = 'manage_options';
//	public  $menu_slug                   = 'wpsp-child-taxonomy-wpsp-category';
	public  $icon_url                    = 'dashicons-admin-generic';
//	public  $position                    = 2;
	public  $parent_slug                 = 'wpsp';
	public  $callback_index              = false;
	public  $is_submenu_page             = true;
//	public  $remove_first_submenu        = false;
	public  $urls_highlight_current_menu = [
		'edit-tags.php?taxonomy=wpsp_category',
		'term.php?taxonomy=wpsp_category'
	];

//	private $checkDatabase               = null;
//	private $table                       = null;
	private $currentTab                  = null;
	private $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.wpsp_child_taxonomy_wpsp_category')) . ' - ' . Funcs::config('app.name');
	}

	/*
	 *
	 */

//	public function init($path = null): void {}

	public function beforeInit(): void {}

	public function afterInit(): void {}

	public function afterLoad($adminPage): void {}

//	public function screenOptions($adminPage): void {}

	/*
	 *
	 */

	public function index(): void {
		echo '<div class="wrap"><h1>Admin page: "wpsp_child_taxonomy_wpsp_category"</h1></div>';
	}

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}