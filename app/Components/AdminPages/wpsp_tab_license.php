<?php

namespace WPSP\app\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Events\SettingsUpdatedEvent;
use WPSP\app\Components\License\License;
use WPSP\app\Workers\Cache\Cache;
use WPSP\app\Workers\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\View\Share;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_license extends BaseAdminPage {

	use InstancesTrait;

	public $menu_title                  = 'Tab: License';
//	public $page_title                  = 'Tab: License';
	public $capability                  = 'manage_options';
//	public $menu_slug                   = 'wpsp&tab=license';
	public $icon_url                    = 'dashicons-admin-generic';
//	public $position                    = 2;
	public $parent_slug                 = 'wpsp';
	public $is_submenu_page             = true;
//	public $remove_first_submenu        = false;
//	public $urls_highlight_current_menu = null;
	public $callback_function           = null;

	public $screen_options              = null;
	public $screen_options_key          = null;

//	private $checkDatabase              = null;
//	private $table                      = null;
	private $currentTab                 = null;
	private $currentPage                = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.license')) . ' - ' . Funcs::config('app.name');
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
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_license"</h1></div>';
	}

	public function update() {
		try {
			$settings = $this->request->get('settings');

//		    $existSettings = Cache::getItemValue('settings');
			$existSettings = SettingsModel::query()->where('key','settings')->first();
			$existSettings = json_decode($existSettings['value'] ?? '', true);
			$existSettings = array_merge($existSettings ?? [], $settings ?? []);

			// Save settings into cache.
//			Cache::set('settings', function() use ($existSettings) {
//				return $existSettings;
//			});

			// Delete license information cache.
//			Cache::delete('license_information');

			// Save settings into database.
			$existSettings = SettingsModel::query()->updateOrCreate([
				'key' => 'settings',
			], [
				'value' => json_encode($existSettings),
			]);

			wpsp_event(new SettingsUpdatedEvent($existSettings, 'old', 'new', '1'), ['payload_1' => 'value_1']);

//			wp_safe_redirect(wp_get_raw_referer() . '&updated=license');
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error');
		}
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}