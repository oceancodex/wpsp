<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_permissions extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title          = 'Tab: Permissions';
//	public $page_title          = 'Tab: Permissions';
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
//	public $removeFirstSubmenu     = false;
//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];
	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;

	/**
	 * Custom properties.
	 */
	private $table       = null;
	private $currentTab  = null;
	private $currentPage = null;

	/*
	 *
	 */

	/**
	 * Tùy biến những thuộc tính chuyên sâu\
	 * hoặc khởi tạo các thuộc tính để tái sử dụng trong toàn bộ class.
	 */
	public function customProperties() {
		// Highlight menu "Table" with type "published".
		$this->urlsMatchHighlightMenu = [
			'admin.php?page=wpsp&tab=permissions',
		];

		$this->urlsMatchCurrentAccess = [
			'admin.php?page=wpsp&tab=permissions',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');

		$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.table')) . ' - ' . Funcs::config('app.name');

		// Chỉ định sreen options key hoạt động độc lập.
		$this->screenOptionsKey = $this->funcs->_slugParams(['page', 'tab']);
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

	public function afterAddAdminPage($adminPage) {}

	public function beforeLoadAdminPage($adminPage) {}

	public function beforeInLoadAdminPage($adminPage) {}

	public function afterInLoadAdminPage($adminPage) {}

	public function afterLoadAdminPage($adminPage) {}

	public function matchedCurrentAccess() {}

	/*
	 *
	 */

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
			$role      = \Spatie\Permission\Models\Permission::query()->create([
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

	public function destroy(Request $request) {}

	public function forceDestroy(Request $request) {}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}