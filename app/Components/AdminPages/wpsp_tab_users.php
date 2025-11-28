<?php

namespace WPSP\App\Components\AdminPages;

use Illuminate\Http\Request;
use WPSP\App\Http\Requests\UsersUpdateRequest;
use WPSP\App\Models\UsersModel;
use WPSP\App\Traits\InstancesTrait;
use WPSP\App\Workers\Auth\Auth;
use WPSP\Funcs;
use WPSPCORE\Auth\Models\DBAuthUserModel;
use WPSPCORE\Components\AdminPages\BaseAdminPage;

class wpsp_tab_users extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title                  = 'Tab: Users';
//	public $page_title                  = 'Tab: Users';
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

	public function beforeInit() {
		try {
			if (!Auth::instance()->guard('web')->check() && $this->currentTab == 'users') {
			// Test AuthenticationException.
//			throw new AuthenticationException('Vui lòng đăng nhập để xem users', ['web'], admin_url('admin.php?page=wpsp'));

			// Test QueryException.
//			global $wpdb;
//			$data = ['title' => 'Test'];
//			$result = $wpdb->update($wpdb->posts, $data, ['ID' => 1]);
//			throw new \WPSP\App\Exceptions\QueryException($wpdb->last_query, $data, 'Failed to update post');
			}
		}
		catch (\Throwable $e) {
//			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 'error', true);
		}
	}

	public function afterInit() {}

	public function afterLoadAdminPage($adminPage) {}

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index() {
		echo '<div class="wrap"><h1>Admin page: "wpsp_tab_table"</h1></div>';
	}

	public function create($request) {

	}

	public function store($request) {

	}

	public function show(Request $request, $id) {
		$action = $this->request->get('action');
		if ($action == 'show' && $id) {
			try {
				// Select user and test ModelNotFoundException.
				$selectedUser = UsersModel::query()->findOrFail($id);
				wpsp_view_inject('modules.admin-pages.wpsp.users', function($view) use ($selectedUser) {
					$view->with('selected_user', $selectedUser);
				});
			}
			catch (\Throwable $e) {
			}
		}
	}

	public function edit(Request $request, $id) {
		$action = $this->request->get('action');
		if ($action == 'edit' && $id) {
			// Select user and test ModelNotFoundException.
			$selectedUser = UsersModel::query()->findOrFail($id);
			wpsp_view_inject('modules.admin-pages.wpsp.users', function($view) use ($selectedUser) {
				$view->with('selected_user', $selectedUser);
			});
		}
	}

	public function update(Request $request, $id) {
//		try {
			$name = $this->request->get('name');
			$email    = $this->request->get('email');

			if (!$name || !$email) throw new \Exception('Username, Email and Password is required. Please try again.');

			// Validate.
			$formRequest = UsersUpdateRequest::createFrom($request);
			$formRequest->input_user_id = $id;
			$formRequest->setContainer(Funcs::app());
			$formRequest->validateResolved();

			$user = UsersModel::query()->find($id)->update([
				'name'  => $name,
				'email' => $email,
			]);
			if ($user) {
				Funcs::notice(Funcs::trans('Updated successfully', true), 'success');
			}
			else {
				Funcs::notice(Funcs::trans('Update failed', true), 'error');
			}
//		}
//		catch (\Throwable $e) {
////			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error');
//			Funcs::notice($e->getMessage(), 'error');
//		}
	}

	public function destroy(Request $request, $userId) {
	}

	public function forceDestroy(Request $request, $userId) {
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}