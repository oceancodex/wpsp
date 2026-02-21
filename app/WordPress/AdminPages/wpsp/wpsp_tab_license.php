<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Events\SettingsUpdatedEvent;
use WPSP\App\Widen\Support\Facades\Cookie;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_license extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title             = 'Tab: License';
	public $page_title             = 'Tab: License';
	public $capability             = 'manage_options';
//	public $menu_slug              = 'wpsp&tab=license';
	public $icon_url               = 'dashicons-admin-generic';
//	public $position               = 2;
	public $parent_slug            = 'wpsp';

	/**
	 * Parent properties.
	 */
	public $classes                = 'license';
//	public $firstSubmenuTitle      = null;
//	public $firstSubmenuClasses    = null;
	public $isSubmenuPage          = true;
//	public $removeFirstSubmenu     = true;

//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];

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
//			'admin.php?page=wpsp&tab=license',
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
//			'/admin\.php\?page=wpsp&tab=license/iu',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
//		$this->page_title  = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.license')) . ' - ' . Funcs::config('app.name');

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

	public function matchedCurrentAccess() {
		// Test thêm cookie.
		$cookie = Cookie::make('wpsp-access-license', 1, 60);
		response(null)->cookie($cookie)->sendHeaders();
	}

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

	public function update(Request $request) {
//		check_admin_referer('save_license_key');

		try {
			$settings = $request->get('settings');

//		    $existSettings = Cache::getItemValue('settings');
			$existSettings = SettingsModel::query()->where('key','settings')->first();
			$existSettings = json_decode($existSettings['value'] ?? '', true);
			$existSettings = array_merge($existSettings ?? [], $settings ?? []);

			// Save settings into cache.
//			Cache::set('settings', function() use ($existSettings) {
//				return $existSettings;
//			});

			// Delete license information cache.
//			Cache::delete('license_information');

			// Save settings into database.
			$existSettings = SettingsModel::query()->updateOrCreate([
				'key' => 'settings',
			], [
				'value' => json_encode($existSettings),
			]);

			SettingsUpdatedEvent::dispatch($existSettings);

//			wp_safe_redirect(wp_get_raw_referer() . '&updated=license');
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