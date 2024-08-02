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

class wpsp_child_example extends BaseAdminPage {

	use InstancesTrait;

	public mixed  $menu_title                  = 'Child: Example';
//	public mixed  $page_title                  = 'Child: Example';
	public mixed  $capability                  = 'manage_options';
//	public mixed  $menu_slug                   = 'wpsp-child-example';
	public mixed  $icon_url                    = 'dashicons-admin-generic';
//	public mixed  $position                    = 2;
	public mixed  $parent_slug                 = 'wpsp';
//	public mixed  $callback_index              = true;
	public mixed  $is_submenu_page             = true;
//	public mixed  $remove_first_submenu        = false;
//	public ?array $urls_highlight_current_menu = null;

//	private mixed $checkDatabase               = null;
	private mixed $table                       = null;
	private mixed $currentTab                  = null;
	private mixed $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.wpsp_child_example')) . ' - ' . Funcs::config('app.name');
	}

	/*
	 *
	 */

//	public function init($path = null): void {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//	}

	public function beforeInit(): void {}

	public function afterInit(): void {}

	public function afterLoad($adminPage): void {}

//	public function screenOptions($adminPage): void {}

	/*
	 *
	 */

	public function index(): void {
		echo '<div class="wrap"><h1>Admin page: "wpsp_child_example"</h1></div>';
	}

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}