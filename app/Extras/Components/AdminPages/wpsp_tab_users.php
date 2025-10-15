<?php

namespace WPSP\app\Extras\Components\AdminPages;

use WPSP\app\Models\UsersModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_users extends BaseAdminPage {

	use InstancesTrait;

	public $menu_title                  = 'Tab: Users';
//	public  $page_title                 = 'Tab: Users';
	public $capability                  = 'manage_options';
//	public  $menu_slug                  = 'wpsp-table';
	public $icon_url                    = 'dashicons-admin-generic';
//	public  $position                   = 2;
	public $parent_slug                 = 'wpsp';
	public $is_submenu_page             = true;
//	public  $remove_first_submenu       = false;
//	public $urls_highlight_current_menu = null;
	public $callback_function           = null;

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
			'admin.php?page=wpsp&tab=users',
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
		$action = $this->request->get('action');
		$id = $this->request->get('id');
		if ($action == 'view' && $id) {
			$selectedUser = UsersModel::query()->find($id);
			$selectedUser->guard_name = ['web', 'api'];
			wpsp_view_inject('modules.admin-pages.wpsp.users', function($view) use ($selectedUser) {
				$view->with('selected_user', $selectedUser);
			});
		}
	}

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
			$username = $this->request->get('username');
			$email    = $this->request->get('email');
			$password = $this->request->get('password');
			if (!$username || !$email || !$password) throw new \Exception('Username, Email and Password is required. Please try again.');
			$user = UsersModel::query()->create([
				'username' => $username,
				'email'    => $email,
				'password' => $password,
			]);
			if ($user) {
				Funcs::notice(Funcs::trans('Create successfully', true), 'success', !class_exists('\WPSPCORE\View\Blade'));
			}
			else {
				Funcs::notice(Funcs::trans('Create failed', true), 'error', !class_exists('\WPSPCORE\View\Blade'));
			}
		}
		catch (\Exception $e) {
			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error', !class_exists('\WPSPCORE\View\Blade'));
		}
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}