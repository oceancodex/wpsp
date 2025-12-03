<?php

namespace WPSP\App\WordPress\AdminPages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use WPSP\App\Http\Requests\UsersUpdateRequest;
use WPSP\App\Instances\Auth\Auth;
use WPSP\App\Instances\InstancesTrait;
use WPSP\App\Instances\Log\Log;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

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

	public function afterAddAdminPage($adminPage) {}

	public function beforeLoadAdminPage($adminPage) {}

	public function inLoadBeforeAdminPage($adminPage) {}

	public function inLoadAfterAdminPage($adminPage) {}

	public function afterLoadAdminPage($adminPage) {}

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index(Request $request) {}

	public function create(Request $request) {
	}

	public function store(Request $request) {
		$action = $this->request->get('action');
		if ($action == 'create') {
			$name     = $this->request->get('name');
			$email    = $this->request->get('email');
			$password = $this->request->get('password');
			$password = Hash::make($password);
			$user = UsersModel::query()->create([
				'name'     => $name,
				'email'    => $email,
				'password' => $password,
			]);
			wp_redirect(Funcs::route('AdminPages', 'wpsp.users.list', ['saved' => 'true'], true));
		}
	}

	public function show(Request $request, UsersModel $user_id) {
//		if (!$request->user()->can('view')) { // Sử dụng Gate/Policies
		if (!$request->user()?->hasRole('super_admin')) {
			Funcs::notice(Funcs::trans('You do not have permission to view this user!', true), 'error');
			wp_die('You do not have permission to view this user!');
		}
		else {
			$action = $this->request->get('action');
//		    if ($action == 'show') {
//			    try {
					// Select user and test ModelNotFoundException.
//				    $selectedUser = UsersModel::query()->findOrFail($user_id);
					$selectedUser = $user_id;
					Funcs::viewInject('modules.admin-pages.wpsp.users', [
						'selected_user' => $selectedUser
					]);
//			    }
//			    catch (\Throwable $e) {
//			    }
//		    }
		}
	}

	public function edit(Request $request, $id) {
		if (!$request->user()?->hasRole('super_admin')) {
			wp_die('You do not have permission to edit this user!');
		}

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
		if (!$request->user()?->hasRole('super_admin')) {
			wp_die('You do not have permission to update this user!');
		}

//		try {
			$name = $this->request->get('name');
			$email    = $this->request->get('email');

			if (!$name || !$email) throw new \Exception('Username, Email and Password is required. Please try again.');

			// Validate.
			$formRequest = UsersUpdateRequest::createFrom($request);
			$formRequest->input_user_id = $id;
			$formRequest->setContainer(Funcs::app());
			$formRequest->validateResolved();

			$user = $cacheUser = UsersModel::query()->find($id);
			$user->update([
				'name'  => $name,
				'email' => $email,
			]);
			if ($cacheUser) {
				Funcs::notice(Funcs::trans('Updated successfully', true), 'success');
//				Event::dispatch(new UsersUpdatedEvent($cacheUser));
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