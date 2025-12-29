<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Support\Facades\View;
use WPSP\App\Widen\Support\Facades\WPRoles;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_roles extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title             = 'Tab: Roles';
//	public $page_title             = 'Tab: Roles';
	public $capability             = 'manage_options';
//	public $menu_slug              = 'wpsp-table';
	public $icon_url               = 'dashicons-admin-generic';
//	public $position               = 2;
	public $parent_slug            = 'wpsp';

	/**
	 * Parent properties.
	 */
//	public $classes                = null;
//	public $firstSubmenuTitle      = null;
//	public $firstSubmenuClasses    = null;
	public $isSubmenuPage          = true;
//	public $removeFirstSubmenu     = false;
//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];
	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;

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
			'admin.php?page=wpsp&tab=roles',
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
			'/admin\.php\?page=wpsp&tab=roles/iu',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
		$this->page_title  = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.roles')) . ' - ' . Funcs::config('app.name');

		/**
		 * Định nghĩa screen option key duy nhất dựa theo params trong URL.\
		 * Ví dụ: page=wpsp&tab=list => wpsp_page_wpsp_tab_list\
		 * Như vậy thì screen options sẽ độc lập giữa các page.
		 */
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

	public function afterAddAdminPage($adminPage) {}

	public function beforeLoadAdminPage($adminPage) {}

	public function beforeInLoadAdminPage($adminPage) {}

	public function afterInLoadAdminPage($adminPage) {}

	public function afterLoadAdminPage($adminPage) {}

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
				$this->table = new \WPSP\App\WordPress\ListTables\Roles();
//				Funcs::viewInject('admin-pages.wpsp.roles', function($view) {
//					$view->with('table', $this->table);
//				});
				View::composer('admin-pages.wpsp.roles', function($view) {
					$view->with('table', $this->table);
				});
			});
		}

		$this->redirectBulkActions();
	}

	public function afterInit() {
		$updated = $this->request->get('updated') ?? null;

		// Bắn thông báo khi refresh custom roles.
		if ($updated == 'refresh-custom-roles') {
			Funcs::notice(Funcs::trans('Refresh all custom roles successfully', true), 'success');
		}
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

	public function store(Request $request) {}

	public function show(Request $request, $id) {}

	public function edit(Request $request, $id) {}

	public function update(Request $request) {
		try {
			$name = $this->request->get('name');
			if (!$name) throw new \Exception('Name is required. Please try again.');
			$guardName = $this->request->get('guard_name');
			if (!$guardName) throw new \Exception('Guard name is required. Please try again.');
			$role      = \Spatie\Permission\Models\Role::query()->create([
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

	public function refresh() {
		WPRoles::instance()->removeAllCustomRoles();
		wp_redirect(admin_url('admin.php?page=' . $this->parent_slug . '&tab=roles&updated=refresh-custom-roles'));
		exit();
	}

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