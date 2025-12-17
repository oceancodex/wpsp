<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Http\Requests\UsersUpdateRequest;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_users extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title          = 'Tab: Users';
//	public $page_title          = 'Tab: Users';
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
		/**
		 * Xác định xem menu này sẽ được highlight khi truy cập bất cứ URL nào hay không.\
		 * Nếu URL hiện tại khớp với một trong các item của mảng thì menu này sẽ được highlight.
		 */
		$this->urlsMatchHighlightMenu = [
			'admin.php?page=wpsp&tab=users',
		];

		/**
		 * Xác định xem menu này có đang thực sự được truy cập hay không.\
		 * Nếu URL hiện tại khớp với một trong các item của mảng thì menu này xem như\
		 * đang được truy cập thực sự:
		 * - Khi đó các cài đặt liên quan đến screen options sẽ được thực thi.
		 * - Khi đó phương thức "matchedCurrentAccess" tại đây sẽ được thực thi.
		 */
		$this->urlsMatchCurrentAccess = [
			'admin.php?page=wpsp&tab=users',
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

	public function beforeInLoadAdminPage($adminPage) {}

	public function afterInLoadAdminPage($adminPage) {}

	public function afterLoadAdminPage($adminPage) {}

	public function matchedCurrentAccess() {
		$this->redirectBulkActions();
	}

	/*
	 *
	 */

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index(Request $request) {}

	public function create(Request $request) {}

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
		try {
//		    if (!$request->user()->can('view')) { // Sử dụng Gate/Policies
			if (!$request->user()?->hasRole('super_admin')) {
				Funcs::notice(Funcs::trans('You do not have permission to view this user!', true), 'error');
//			    wp_die('You do not have permission to view this user!');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in: ' . __FILE__, 'error');
		}


		$action = $this->request->get('action');
		if ($action == 'show') {
//			try {
				// Select user and test ModelNotFoundException.
//			    $selectedUser = UsersModel::query()->findOrFail($user_id);
				$selectedUser = $user_id;
				Funcs::viewInject('modules.admin-pages.wpsp.users', [
					'selected_user' => $selectedUser,
				]);
//			}
//			catch (\Throwable $e) {
//			}
		}
	}

	public function edit(Request $request, $id) {
		try {
			if (!$request->user()?->hasRole('super_admin')) {
				wp_die('You do not have permission to edit this user!');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in: ' . __FILE__, 'error');
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
		try {
			if (!$request->user()?->hasRole('super_admin')) {
				wp_die('You do not have permission to update this user!');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in: ' . __FILE__, 'error');
		}

//		try {
			$name  = $this->request->get('name');
			$email = $this->request->get('email');

			if (!$name || !$email) throw new \Exception('Username, Email and Password is required. Please try again.');

			/**
			 * Validate dữ liệu bằng cách:
			 * 1. Khởi tạo form request.
			 * 2. Truyền thêm thuộc tính.
			 * 3. Validate dữ liệu.
			 */
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

	public function destroy(Request $request, $userId) {}

	public function forceDestroy(Request $request, $userId) {}

	/*
	 *
	 */

	public function redirectBulkActions() {
		/**
		 * Danh sách các query var cần loại bỏ khỏi URL khi xử lý redirect.\
		 * Thường dùng sau khi submit form bulk action để tránh lặp lại action cũ.
		 */
		$removeQueryVars = [
			'_wp_http_referer',
			'_wpnonce',
			'action',
			'action2',
			'filter_action',
			'id',
			'items',
			'bulk_action',
		];

		if (
			isset($_REQUEST['action']) && isset($_REQUEST['action2']) || isset($_REQUEST['_wpnonce'])
		) {
			wp_safe_redirect(remove_query_arg($removeQueryVars, stripslashes($_SERVER['REQUEST_URI'])));
			exit;
		}
	}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}