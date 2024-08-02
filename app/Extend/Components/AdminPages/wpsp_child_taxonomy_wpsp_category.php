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

	public mixed  $menu_title                  = 'WPSP Category';
//	public mixed  $page_title                  = 'wpsp_child_taxonomy_wpsp_category';
	public mixed  $capability                  = 'manage_options';
//	public mixed  $menu_slug                   = 'wpsp-child-taxonomy-wpsp-category';
	public mixed  $icon_url                    = 'dashicons-admin-generic';
//	public mixed  $position                    = 2;
	public mixed  $parent_slug                 = 'wpsp';
	public mixed  $callback_index              = false;
	public mixed  $is_submenu_page             = true;
//	public mixed  $remove_first_submenu        = false;
	public ?array $urls_highlight_current_menu = ['/edit-tags.php\?taxonomy=wpsp_category/', '/term.php\?taxonomy=wpsp_category/'];

//	private mixed $checkDatabase               = null;
//	private mixed $table                       = null;
	private mixed $currentTab                  = null;
	private mixed $currentPage                 = null;

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