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

class wpsp_tab_settings extends BaseAdminPage {

	public mixed  $menu_title                  = 'Tab: Settings';
//	public mixed  $page_title                  = 'Tab: Settings';
	public mixed  $capability                  = 'manage_options';
//	public mixed  $menu_slug                   = 'wpsp-settings';
	public mixed  $icon_url                    = 'dashicons-admin-generic';
//	public mixed  $position                    = 2;
	public mixed  $parent_slug                 = 'wpsp';
	public mixed  $is_submenu_page             = true;
//	public mixed  $remove_first_submenu        = false;
//	public ?array $urls_highlight_current_menu = null;
	public mixed  $custom_properties           = null;
	public mixed  $callback_function           = null;

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

	public function update(): void {
		try {
			$tab = $this->request->get('tab');
			if ($tab !== 'table') {
				$settings = $this->request->get('settings');

//			    $existSettings = Cache::getItemValue('settings');
				$existSettings = SettingsModel::query()->where('key','settings')->first();
				$existSettings = json_decode($existSettings['value'] ?? '', true);
				$existSettings = array_merge($existSettings ?? [], $settings ?? []);

				// Save settings into cache.
//			    Cache::set('settings', function() use ($existSettings) {
//			    	return $existSettings;
//			    });

				// Delete license information cache.
//				Cache::delete('license_information');

				// Save settings into database.
				SettingsModel::updateOrCreate([
					'key' => 'settings',
				], [
					'value' => json_encode($existSettings),
				]);
			}
		}
		catch (\Exception|\Throwable $e) {
			Funcs::debug($e->getMessage());
		}

		wp_safe_redirect(wp_get_raw_referer() . '&updated=settings');
	}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}