<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_dashboard extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title             = 'Tab: Dashboard';
	public $page_title             = 'Tab: Dashboard';
	public $capability             = 'read';
//	public $menu_slug              = 'wpsp&tab=dashboard';
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
//	public $removeFirstSubmenu     = true;

//	public $urlsMatchCurrentAccess = [];
	public $urlsMatchHighlightMenu = ['/admin\.php\?page=wpsp$/'];

//	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;
//	public $screenOptionsPageNow   = null;

//	public $adminPageMetaBoxes     = [];

	/**
	 * Custom properties.
	 */
	private $currentTab            = null;
	private $currentPage           = null;
//	private $table                 = null;

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
//		$this->adminPageMetaBoxes = [];

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

	public function afterLoadAdminPage($adminPage) {}

	public function matchedCurrentAccess() {}

	public function afterInit() {}

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

	public function update(Request $request) {}

	public function destroy(Request $request) {}

	public function forceDestroy(Request $request) {}

	/*
	 *
	 */

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}