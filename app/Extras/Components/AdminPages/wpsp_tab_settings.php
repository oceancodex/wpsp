<?php

namespace WPSP\app\Extras\Components\AdminPages;

use WPSP\app\Exceptions\ModelNotFoundException;
use WPSP\app\Http\Requests\SettingsUpdateRequest;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_settings extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title                  = 'Tab: Settings';
//	public $page_title                  = 'Tab: Settings';
	public $capability                  = 'manage_options';
//	public $menu_slug                   = 'wpsp-settings';
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
	public $screen_options              = null;
	public $screen_options_key          = null;

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
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.settings')) . ' - ' . Funcs::config('app.name');
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

	public function afterInit() {
		// Test QueryException.
		global $wpdb;
		$data = ['title' => 'Test'];
		$result = $wpdb->update($wpdb->posts, $data, ['ID' => 1]);
		throw new \WPSP\app\Exceptions\QueryException($wpdb->last_query, $data, 'Failed to update post');
	}

	public function afterLoad($adminPage) {}

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index() {
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_settings"</h1></div>';
	}

	public function update() {
		// Validate sử dụng FormRequest.
		$request = new SettingsUpdateRequest();
		$request->validated();

		$settings = $this->request->get('settings');

//		$existSettings = Cache::getItemValue('settings');
		$existSettings = SettingsModel::query()->where('key','settings')->first();
		$existSettings = json_decode($existSettings['value'] ?? '', true);
		$existSettings = array_merge($existSettings ?? [], $settings ?? []);

		// Save settings into cache.
//	    Cache::set('settings', function() use ($existSettings) {
//	        return $existSettings;
//	    });

		// Delete license information cache.
//		Cache::delete('license_information');

		// Save settings into database.
		SettingsModel::query()->updateOrCreate([
			'key' => 'settings',
		], [
			'value' => json_encode($existSettings),
		]);

		wp_safe_redirect(wp_get_raw_referer() . '&updated=settings');
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}