<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_table extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title          = 'Tab: Table';
//	public $page_title          = 'Tab: Table';
//	public $first_submenu_title = null;
	public $capability          = 'manage_options';
//	public $menu_slug           = 'wpsp-table';
	public $icon_url            = 'dashicons-admin-generic';
//	public $position            = 2;
	public $parent_slug         = 'wpsp';


	/**
	 * Parent properties.
	 */
	public $is_submenu_page           = true;
//	public $remove_first_submenu      = false;
//	public $urls_match_current_access = [];
//	public $urls_match_highlight_menu = [];
//	public $show_screen_options       = true;
//	public $screen_options_key        = null;

	/**
	 * Custom properties.
	 */
	private $table         = null;
	private $currentTab    = null;
	private $currentPage   = null;

	/*
	 *
	 */

	public function customProperties() {
		// Highlight menu "Table" with type "published".
		$this->urls_match_highlight_menu = [
			'admin.php?page=wpsp&tab=table',
		];

		$this->urls_match_current_access = [
			'admin.php?page=wpsp&tab=table',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');

		$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.table')) . ' - ' . Funcs::config('app.name');

//		$this->screen_options_key = $this->funcs->_slugParams(['page', 'tab']);
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

	public function index(Request $request) {}

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
				Funcs::notice(Funcs::trans('Create successfully', true), 'success');
			}
			else {
				Funcs::notice(Funcs::trans('Create failed', true), 'error');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage(), 'error');
		}
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}