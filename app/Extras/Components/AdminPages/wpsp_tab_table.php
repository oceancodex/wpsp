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

class wpsp_tab_table extends BaseAdminPage {

	public $menu_title = 'Tab: Table';
//	public  $page_title                  = 'Tab: Table';
	public $capability = 'manage_options';
//	public  $menu_slug                   = 'wpsp-table';
	public $icon_url = 'dashicons-admin-generic';
//	public  $position                    = 2;
	public $parent_slug     = 'wpsp';
	public $is_submenu_page = true;
//	public  $remove_first_submenu        = false;
//	public $urls_highlight_current_menu = null;
	public $custom_properties = null;
	public $callback_function = null;

//	private mixed $checkDatabase               = null;
//	private mixed $table                       = null;
	private mixed $currentTab                  = null;
	private mixed $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties() {

		// Highlight menu "Table" with type "published".
		$this->urls_highlight_current_menu = [
			'admin.php?page=wpsp&tab=table',
		];

		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.table')) . ' - ' . Funcs::config('app.name');
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
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_table"</h1></div>';
	}

	public function update() {
		try {
			$key = $this->request->get('key');
			if (!$key) throw new \Exception('Key is required. Please try again.');
			$value   = $this->request->get('value');
			$setting = SettingsModel::query()->create([
				'key'   => $key,
				'value' => $value,
			]);
			if ($setting) {
				Funcs::notice(Funcs::trans('Create successfully', true), 'success', !class_exists('\WPSPCORE\View\Blade'));
			}
			else {
				Funcs::notice(Funcs::trans('Create failed', true), 'error', !class_exists('\WPSPCORE\View\Blade'));
			}
		}
		catch (\Exception $e) {
			Funcs::notice($e->getMessage(), 'error', !class_exists('\WPSPCORE\View\Blade'));
		}
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}