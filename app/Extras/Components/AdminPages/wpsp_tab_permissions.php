<?php

namespace WPSP\app\Extras\Components\AdminPages;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;
use WPSPCORE\Permission\Models\PermissionsModel;

class wpsp_tab_permissions extends BaseAdminPage {

	use InstancesTrait;

	public $menu_title = 'Tab: Permissions';
//	public  $page_title                  = 'Tab: Permissions';
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

//	private $checkDatabase               = null;
//	private $table                       = null;
	private $currentTab                  = null;
	private $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties() {

		// Highlight menu "Table" with type "published".
		$this->urls_highlight_current_menu = [
			'admin.php?page=wpsp&tab=permissions',
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
			$name = $this->request->get('name');
			if (!$name) throw new \Exception('Name is required. Please try again.');
			$guardName = $this->request->get('guard_name');
			if (!$guardName) throw new \Exception('Guard name is required. Please try again.');
			$role      = PermissionsModel::query()->create([
				'name'       => $name,
				'guard_name' => $guardName,
			]);
			if ($role) {
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