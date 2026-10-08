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
	public $menu_title             = 'Tab: Users';
//	public $page_title             = 'Tab: Users';
	public $capability             = 'manage_options';
	public $menu_slug              = 'wpsp&tab=users'; // [1] Khớp với URL có params và callback "index", ép admin menu page có slug như này để tránh URL chứa Regex ở Route.
	public $icon_url               = 'dashicons-admin-generic';
//	public $position               = 2;
	public $parent_slug            = 'wpsp';

	/**
	 * Parent properties.
	 */
//	public $forceInit			   = false;
//	public $forceInitSlug          = null;

//	public $classes                = null;
//	public $firstSubmenuTitle      = null;
//	public $firstSubmenuClasses    = null;
	public $isSubmenuPage          = true;
//	public $removeFirstSubmenu     = true;

	public $showScreenOptions      = true;
//	public $screenBase			   = null;
//	public $screenId			   = null;
//	public $pagenow				   = null;
//	public $itemsPerPageKey		   = null;

//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];

//	public $adminPageMetaBoxes     = [];

//	public $callback_function	   = false;

	/**
	 * Custom properties.
	 */
	private $currentTab            = null;
	private $currentPage           = null;
	private $table                 = null;

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
		 *
		 * Cần phải làm điều này để thực thi những công việc mà chỉ menu này cần.\
		 * Chấp nhận String hoặc Regex.
		 */
		$this->urlsMatchCurrentAccess = [
			'/admin\.php\?page=wpsp&tab=users/iu',
		];

		/**
		 * Định nghĩa các metaboxes sẽ được hiển thị trong admin page.
		 */
		$this->adminPageMetaBoxes = [];

		/**
		 * Định nghĩa screen option key duy nhất dựa theo params trong URL.\
		 * Ví dụ: page=wpsp&tab=list => wpsp_page_wpsp_tab_list\
		 * Như vậy thì screen options sẽ độc lập giữa các page.
		 */
		$this->screenId = $this->funcs->_slugParams(['page', 'tab']);

		/**
		 * Ghi đè "pagenow" để gửi Ajax sắp xếp lại các metaboxes trong admin page\
		 * và screen layout columns.
		 */
		$this->pagenow = $this->funcs->_slugParams(['page', 'tab']);

		/**
		 * Lấy các parameters từ URL để tái sử dụng trong Class này.
		 */
		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
//		$this->page_title  = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.users')) . ' - ' . Funcs::config('app.name');
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

//	public function beforeInit() {
//		try {
//			if (!Auth::guard('web')->check() && $this->currentTab == 'users') {
//			// Test AuthenticationException.
//			throw new AuthenticationException('Vui lòng đăng nhập để xem users', ['web'], admin_url('admin.php?page=wpsp'));
//
//			// Test QueryException.
//			global $wpdb;
//			$data = ['title' => 'Test'];
//			$result = $wpdb->update($wpdb->posts, $data, ['ID' => 1]);
//			throw new \WPSP\App\Exceptions\QueryException($wpdb->last_query, $data, 'Failed to update post');
//			}
//		}
//		catch (\Throwable $e) {
//			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 'error', true);
//		}
//	}

//	public function afterAddAdminPage($adminPage) {}

//	public function beforeLoadAdminPage($adminPage) {}

//	public function beforeInLoadAdminPage($adminPage) {}

//	public function afterInLoadAdminPage($adminPage) {}

//	public function afterLoadAdminPage($adminPage) {}

	public function matchedCurrentAccess() {
		/**
		 * Xác định xem URL hiện tại có phải là trang danh sách hay không.\
		 * Bằng cách kiểm tra params trong URL.
		 */
		$isListPage = !Funcs::hasQueryParams($this->request->getQueryString(), [
			['action' => 'show'],
			['action' => 'create'],
		]);

		if ($isListPage) {
			add_action('current_screen', function($screen) {
				$this->table = new \WPSP\App\WordPress\ListTables\Users();
				Funcs::viewInject('admin-pages.wpsp.users', function($view) {
					$view->with('table', $this->table);
				});
			});
		}

		// Test gọi method "index" với DependencyInjection và Model binding.
//		$this->callAdminPageMethod('index');
	}

//	public function afterInit() {}

	/*
	 *
	 */

	public function index(Request $request) {
//		dd($this->request->route('user_id'));
	}

	public function create(Request $request) {}

	public function store(Request $request) {
		$action = $this->request->get('doaction');
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

	public function show(Request $request, UsersModel|int|null $user) {
		try {
//		    if (!$request->user()->can('view')) { // Sử dụng Gate/Policies
			if (!$request->user()?->hasRole('super_admin')) {
				Funcs::notice(Funcs::trans('You do not have permission to view this user!', null, true), 'error');
//			    wp_die('You do not have permission to view this user!');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in: ' . __FILE__ . ':' . __LINE__, 'error');
		}


		$action = $this->request->get('doaction');
		if ($action == 'show') {
//			try {
				// Select user and test ModelNotFoundException.
//			    $selectedUser = UsersModel::query()->findOrFail($user_id);
				Funcs::viewInject('admin-pages.wpsp.users', [
					'selected_user' => $user,
				]);
//			}
//			catch (\Throwable $e) {
//			}
		}
	}

	public function edit(Request $request, $id) {
		try {
			if (!$request->user()?->hasRole('super_admin')) {
				Funcs::notice(Funcs::trans('You do not have permission to edit this user!', null, true), 'error');
//				wp_die('You do not have permission to edit this user!');
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in: ' . __FILE__, 'error');
		}

		$action = $this->request->get('doaction');
		if ($action == 'edit' && $id) {
			// Select user and test ModelNotFoundException.
			$selectedUser = UsersModel::query()->findOrFail($id);
			wpsp_view_inject('admin-pages.wpsp.users', function($view) use ($selectedUser) {
				$view->with('selected_user', $selectedUser);
			});
		}
	}

	public function update(Request $request, $id) {
//		try {
//			if (!$request->user()?->hasRole('super_admin')) {
//				wp_die('You do not have permission to update this user!');
//			}
//		}
//		catch (\Throwable $e) {
//			Funcs::notice($e->getMessage() . ' in: ' . __FILE__, 'error');
//		}

//		try {
			$name  = $this->request->get('name');
			$email = $this->request->get('email');

//			if (!$name || !$email) throw new \Exception('Username, Email and Password is required. Please try again.');

			/**
			 * Validate dữ liệu bằng cách:
			 * 1. Khởi tạo form request.
			 * 2. Truyền thêm thuộc tính.
			 * 3. Validate dữ liệu.
			 *
			 * => Nếu không hợp lệ sẽ redirect()->back()->withErrors($validator)->withInput()
			 */
			$formRequest = UsersUpdateRequest::createFrom($request);
			$formRequest->input_user_id = $id;
			$formRequest->setContainer(Funcs::app());
			$formRequest->validateResolved();

			$user = UsersModel::query()->find($id);

			$updated = $user->update([
				'name'  => $name,
				'email' => $email,
			]);


			/**
			 * Sử dụng response() hay redirect() thì cần phải có ->send() và exit;
			 */
			if ($updated) {
//				Funcs::notice(Funcs::trans('Updated successfully', null, true), 'success');
//				Event::dispatch(new UsersUpdatedEvent($cacheUser));
				response()->redirectTo(Funcs::route('AdminPages', 'wpsp.users.edit', [
					'id'      => $id,
					'updated' => true,
				], true))->withInput()->send();
//				redirect()->back()->withInput()->with(['success' => true])->send();
			}
			else {
//				Funcs::notice(Funcs::trans('Update failed', null, true), 'error');
				response()->redirectTo(Funcs::route('AdminPages', 'wpsp.users.edit', [
					'id'    => $id,
					'error' => 'Update failed',
				], true))->withInput()->send();
//				redirect()->back()->withInput()->with(['success' => '123'])->send();
			}

			exit;
//		}
//		catch (\Throwable $e) {
////			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error');
//			Funcs::notice($e->getMessage(), 'error');
//		}
	}

	public function destroy(Request $request, $userId) {}

	public function forceDestroy(Request $request, $userId) {}

	public function bulkUpdate(Request $request) {
		$items = $this->request->query('items');
		$bulkEdit = $this->request->query('bulk_edit');

		if ($items && $bulkEdit) {
			error_log(print_r($items, true));
			error_log(print_r($bulkEdit, true));
			$bulkEdit = array_filter($bulkEdit, function ($value) {
				return $value !== null && $value !== '';
			});

			try {
				$updated = UsersModel::query()
					->whereIn('id', $items)
					->update($bulkEdit);
				$message = 'Updated successfully';
			} catch (\Exception $e) {
				$updated = false;
				$message = $e->getMessage();
			}

			if (!$updated) {
				Funcs::notice(Funcs::trans($message, null, true), 'error');
			}
			else {
				Funcs::notice(Funcs::trans($message, null, true), 'success');
			}
		}
	}

	/*
	 *
	 */

//	public function styles() {}

//	public function scripts() {}

//	public function localizeScripts() {}

}