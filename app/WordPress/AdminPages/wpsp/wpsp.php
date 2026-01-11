<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Models\WPUsersModel;
use WPSP\App\Widen\Support\Facades\DB;
use WPSP\App\Widen\Support\Facades\Migration;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title             = 'WPSP Panel';
	public $page_title             = 'WPSP Panel'; // Thẻ <title> trong HTML.
	public $capability             = 'read';
//	public $menu_slug              = 'wpsp';
	public $icon_url               = 'dashicons-analytics';
	public $position               = 2;
//	public $parent_slug            = 'options-general.php';

	/**
	 * Parent properties.
	 */
//	public $classes                = null;
//	public $firstSubmenuTitle      = null;
	public $firstSubmenuClasses    = 'wpsp';
//	public $isSubmenuPage          = false;
//	public $removeFirstSubmenu     = true;

//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];

//	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;
//	public $screenOptionsPageNow   = null;

//	public $adminPageMetaboxes     = [];

	/**
	 * Custom properties.
	 */
	private $currentTab            = null;
	private $currentPage           = null;
	private $table                 = null;
	private $checkDatabase         = null;

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
//			'admin.php?page=wpsp&tab=dashboard',
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
//			'/admin\.php\?page=wpsp&tab=dashboard/iu',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
//		$this->page_title  = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');

		/**
		 * Định nghĩa các metaboxes sẽ được hiển thị trong admin page.
		 */
//		$this->adminPageMetaboxes = [];

		/**
		 * Định nghĩa screen option key duy nhất dựa theo params trong URL.\
		 * Ví dụ: page=wpsp&tab=list => wpsp_page_wpsp_tab_list\
		 * Như vậy thì screen options sẽ độc lập giữa các page.
		 */
//		$this->screenOptionsKey = $this->funcs->_slugParams(['page', 'tab']);

		/**
		 * Ghi đè "pagenow" để gửi Ajax sắp xếp lại các metaboxes trong admin page\
		 * và screen layout columns.
		 */
//		$this->screenOptionsPageNow = $this->funcs->_slugParams(['page', 'tab']);
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

	public function afterLoadAdminPage($adminPage) {
		if ($this->request->get('saved')) {
			Funcs::notice('Đã tạo thành công', 'success');
		}
		elseif ($this->request->get('updated')) {
			Funcs::notice('Đã cập nhật thành công', 'success');
		}
		elseif ($this->request->get('trashed')) {
			Funcs::notice('Đã đưa vào thùng rác', 'success');
		}
		elseif ($this->request->get('untrashed')) {
			Funcs::notice('Đã khôi phục thành công', 'success');
		}
		elseif ($this->request->get('deleted')) {
			Funcs::notice('Đã xóa vĩnh viễn', 'success');
		}
		elseif ($this->request->get('locked')) {
			Funcs::notice('Đã khóa', 'success');
		}
		elseif ($error = $this->request->get('error')) {
			Funcs::notice('Có lỗi xảy ra: ' . $error, 'error');
		}
		elseif ($message = $this->request->get('message')) {
			Funcs::notice($message, 'info');
		}
	}

	public function matchedCurrentAccess() {}

	public function afterInit() {
		/**
		 * Custom highlight current menu.
		 */
//		if (preg_match('/' . $this->menu_slug . '$|' . $this->menu_slug . '&updated=true$/', $this->request->getRequestUri())) {
//			add_filter('submenu_file', function($submenu_file) {
//				return $this->menu_slug;
//			});
//		}

		/**
		 * Chuyển hướng đến tab "Database" nếu database version không hợp lệ.
		 */
		try {
			if ($this->currentPage == $this->menu_slug) {
				// Check database version and maybe redirect.
				$this->checkDatabase = Migration::instance()->checkDatabaseVersion();
				if (empty($this->checkDatabase['result']) && $this->currentTab !== 'database') {
					$url = Funcs::instance()->_buildUrl($this->parent_slug, [
						'page' => $this->menu_slug,
						'tab'  => 'database',
					]);
					wp_redirect($url);
				}
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 'error');
		}
	}

	/*
	 *
	 */

//	public function screenOptions($adminPage) {}

	/*
	 *
	 */

	public function index(Request $request) {
		$requestParams = $request->all();
		$menuSlug      = $this->menu_slug;

		try {
			$settings = SettingsModel::query()->where('key', 'settings')->pluck('value')->first();
			$settings = json_decode($settings ?? '', true);
			
			$wpUser = WPUsersModel::find(1)->toArray();

//		    $checkLicense  = License::checkLicense();

			$table = $this->table;
			echo Funcs::view('admin-pages.wpsp.main', compact(
				'requestParams',
				'menuSlug',
//			    'checkLicense',
				'settings',
				'table',
				'wpUser'
			))->with([
				'checkDatabase' => $this->checkDatabase,
			]);
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' <code>(' . __CLASS__ . ')</code>', 'error');

			$user          = wp_get_current_user();
			$checkDatabase = $this->checkDatabase;
			$funcs         = Funcs::instance();

			include(Funcs::instance()->_getResourcesPath('/views/admin-pages/wpsp/main.php'));
		}
	}

	public function create(Request $request) {}

	public function store(Request $request) {}

	public function show(Request $request) {}

	public function edit(Request $request) {}

	public function update(Request $request) {}

	public function destroy(Request $request) {}

	public function forceDestroy(Request $request) {}

	/*
	 *
	 */

	public function styles() {
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-admin',
			Funcs::instance()->_getPublicUrl() . '/css/admin.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-grid',
			Funcs::instance()->_getPublicUrl() . '/widen/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/widen/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts() {
		wp_enqueue_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::instance()->_getPublicUrl() . '/ts/web/admin-pages/wpsp/Database.min.js',
			null,
			Funcs::instance()->_getVersion(),
			true
		);
	}

	public function localizeScripts() {
		wp_localize_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::config('app.short_name') . '_localize',
			[
				'ajax_url'   => admin_url('admin-ajax.php'),
				'nonce'      => wp_create_nonce(Funcs::config('app.short_name')),
				'public_url' => Funcs::instance()->_getPublicUrl(),
			]
		);
	}

}