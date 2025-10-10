<?php

namespace WPSP\app\Extras\Components\AdminPages;

use WPSP\app\Models\UsersModel;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_users extends BaseAdminPage {

	use InstancesTrait;

	public mixed  $menu_title                  = 'Tab: Users';
//	public mixed  $page_title                  = 'Tab: Users';
	public mixed  $capability                  = 'manage_options';
//	public mixed  $menu_slug                   = 'wpsp-table';
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

//	public function init($path = null): void {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//
//      // Your code here...
//	}

	public function beforeInit(): void {}

	public function afterInit(): void {
		$action = $this->request->get('action');
		$id = $this->request->get('id');
		if ($action == 'view' && $id) {
			$selectedUser = UsersModel::query()->find($id);
			$selectedUser->guard_name = ['web', 'api'];
			echo '<pre>'; print_r($selectedUser->can('api_edit_articles')); echo '</pre>';
			wpsp_view_inject('modules.admin-pages.wpsp.users', function($view) use ($selectedUser) {
				$view->with('selected_user', $selectedUser);
			});
		}
	}

	public function afterLoad($adminPage): void {}

//	public function screenOptions($adminPage): void {}

	/*
	 *
	 */

	public function index(): void {
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_table"</h1></div>';
	}

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}