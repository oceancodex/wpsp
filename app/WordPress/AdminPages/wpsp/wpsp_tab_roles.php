<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Support\Facades\WPRoles;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_roles extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title          = 'Tab: Roles';
//	public $page_title          = 'Tab: Roles';
//	public $first_submenu_title = null;
	public $capability          = 'manage_options';
//	public $menu_slug           = 'wpsp-table';
	public $icon_url            = 'dashicons-admin-generic';
//	public $position            = 2;
	public $parent_slug         = 'wpsp';

	/**
	 * Parent properties.
	 */
	public $isSubmenuPage          = true;
//	public $removeFirstMenu        = false;
//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];
	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;

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
			'admin.php?page=wpsp&tab=roles',
		];

		$this->urls_match_current_access = [
			'admin.php?page=wpsp&tab=roles',
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

	public function afterInit() {
		$updated = $this->request->get('updated') ?? null;
		if ($updated == 'refresh-custom-roles') {
			Funcs::notice(Funcs::trans('Refresh all custom roles successfully', true), 'success');
		}
	}

	public function afterLoadAdminPage($adminPage) {}

	public function afterAddAdminPage($adminPage) {}

	public function inLoadBeforeAdminPage($adminPage) {}

	public function inLoadAfterAdminPage($adminPage) {}

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index(Request $request) {}

	public function create(Request $request) {}

	public function store(Request $request) {}

	public function show(Request $request, $id) {}

	public function edit(Request $request, $id) {}

	public function update(Request $request) {
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