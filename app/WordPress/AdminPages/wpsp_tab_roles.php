<?php

namespace WPSP\App\WordPress\AdminPages;

use WPSP\App\Instances\WPRoles\WPRoles;
use WPSP\App\Models\RolesModel;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_roles extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title                  = 'Tab: Roles';
//	public $page_title                  = 'Tab: Roles';
//	public $first_submenu_title         = null;
	public $capability                  = 'manage_options';
//	public $menu_slug                   = 'wpsp-table';
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
	protected $screen_options           = null;
	protected $screen_options_key       = null;

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
		// Highlight menu "Table" with type "published".
		$this->urls_highlight_current_menu = [
			'admin.php?page=wpsp&tab=roles',
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

	public function afterInit() {
		$updated = $this->request->get('updated') ?? null;
		if ($updated == 'refresh-custom-roles') {
			Funcs::notice(Funcs::trans('Refresh all custom roles successfully', true), 'success');
		}
	}

	public function afterLoadAdminPage($adminPage) {}

	public function afterAddAdminPage() {}

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
			$role      = RolesModel::query()->create([
				'name'       => $name,
				'guard_name' => $guardName,
			]);
			if ($role) {
				Funcs::notice(Funcs::trans('Create successfully', true), 'success');
			}
			else {
				Funcs::notice(Funcs::trans('Create failed', true), 'error');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error');
		}
	}

	public function refresh() {
		WPRoles::instance()->removeAllCustomRoles();
		wp_redirect(admin_url('admin.php?page=' . $this->parent_slug . '&tab=roles&updated=refresh-custom-roles'));
		exit();
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}