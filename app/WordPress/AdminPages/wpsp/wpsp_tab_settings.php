<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Http\Requests\SettingsUpdateRequest;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp_tab_settings extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title             = 'Tab: Settings';
//	public $page_title             = 'Tab: Settings';
	public $capability             = 'manage_options';
//	public $menu_slug              = 'wpsp-settings';
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
//	public $urlsMatchHighlightMenu = [];

	public $showScreenOptions      = true;
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
			'admin.php?page=wpsp&tab=settings',
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
			'/admin\.php\?page=wpsp&tab=settings/iu',
		];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
		$this->page_title  = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.settings')) . ' - ' . Funcs::config('app.name');

		/**
		 * Định nghĩa các metaboxes sẽ được hiển thị trong admin page.
		 */
		$this->adminPageMetaBoxes = $this->prepareAdminPageMetaBoxes();

		/**
		 * Định nghĩa screen option key duy nhất dựa theo params trong URL.\
		 * Ví dụ: page=wpsp&tab=list => wpsp_page_wpsp_tab_list\
		 * Như vậy thì screen options sẽ độc lập giữa các page.
		 */
		$this->screenOptionsKey = $this->funcs->_slugParams(['page', 'tab']);

		/**
		 * Ghi đè "pagenow" để gửi Ajax sắp xếp lại các metaboxes trong admin page\
		 * và screen layout columns.
		 */
		$this->screenOptionsPageNow = $this->funcs->_slugParams(['page', 'tab']);
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
		Funcs::viewInject('admin-pages.wpsp.settings', [
			'admin_page_meta_boxes' => $this->adminPageMetaBoxes(),
			'screen_columns' => $this->screenColumns(),
		]);
	}

	public function afterInit() {
		// Test InvalidDataException.
//		Funcs::validate($this->request->query->all(), [
//			'tab' => ['required', 'string', 'min:100'],
//		]);

		// Test QueryException.
//		global $wpdb;
//		$data = ['title' => 'Test'];
//		$result = $wpdb->update($wpdb->posts, $data, ['ID' => 1]);
//		throw new \WPSP\App\Exceptions\QueryException($wpdb->last_query, $data, 'Testing QueryException...');

		// Test ModelNotFoundException.
//		$model = \WPSP\App\Models\SettingsModel::query()->findOrFail(9999999)->first();
//		throw new ModelNotFoundException(SettingsModel::class, 'Testing ModelNotFoundException...');

		// Test AuthorizationException.
//		throw new AuthorizationException('Testing AuthorizationException...');

		// Test AuthenticationException.
//		throw new AuthenticationException('Testing AuthenticationException...');

		// Test HttpException.
//		throw new \WPSP\App\Exceptions\HttpException(500, 'Testing HttpException...');
	}

	/*
	 *
	 */

	public function prepareAdminPageMetaBoxes() {
		return [
			'side' => [
				'submitdiv' => [
					'title' => 'Submit',
					'view'  => 'admin-pages.wpsp.settings.submit',
				],
			],
			'normal' => [
				'inputsdiv' => [
					'title' => 'Settings',
					'view'  => 'admin-pages.wpsp.settings.inputs',
				],
			],
			'advanced' => [],
		];
	}

	/*
	 *
	 */

	public function index(Request $request) {}

	public function create(Request $request) {}

	public function store(Request $request) {}

	public function show(Request $request, $id) {}

	public function edit(Request $request, $id) {}

	public function update(SettingsUpdateRequest $request) {
//		dd($this->request->route());

//		try {
			// Validate trực tiếp 1.
//			$this->request->validate([
//				'test' => ['required', 'string', 'min:100'],
//			], [
//				'test.required' => 'Test is required.',
//			]);

			// Validate trực tiếp 2.
//			$this->request->validation->validate(
//				$this->request->all(),
//				[
//					'test' => ['required', 'string', 'min:100']
//				],
//				[
//					'test.required' => 'Test là bắt buộc.'
//				]
//			);
//
//			$request->validate([
//				'test' => 'required|string|min:100',
//			], [
//				'test' => 'Test là bắt buộc.',
//			]);

			// Validate sử dụng FormRequest.
//			$app     = Application::instance();
//			$request = SettingsUpdateRequest::createFrom(app('request'));
//			$request->setContainer($app);
//			$request->setRedirector($app->make('redirect'));
//			$request->validateResolved();
//			$request->validated();

			$settings = $request->get('settings');
			$test     = $request->get('test');

//		    $existSettings = Cache::getItemValue('settings');
			$existSettings = SettingsModel::query()->where('key', 'settings')->first();
			$existSettings = json_decode($existSettings['value'] ?? '', true);
			$existSettings = array_merge($existSettings ?? [], $settings ?? []);

			// Save settings into cache.
//	        Cache::set('settings', function() use ($existSettings) {
//	            return $existSettings;
//	        });

			// Delete license information cache.
//		    Cache::delete('license_information');

			// Save settings into database.
			$settings = SettingsModel::query()->updateOrCreate([
				'key' => 'settings',
			], [
				'value' => json_encode($existSettings),
			]);

			if ($test) {
				$test = SettingsModel::query()->updateOrCreate([
					'key' => 'test',
				], [
					'value' => $test,
				]);
			}

			wp_redirect(Funcs::route('AdminPages', 'wpsp.settings.index', ['updated' => true], true));
//		}
//		catch (\Throwable $e) {
//			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . ' => File: ' . __FILE__, 'error');
//		}
	}

	public function destroy(Request $request) {}

	public function forceDestroy(Request $request) {}

	/*
	 *
	 */

	public function styles() {
		wp_enqueue_style( 'jquery-ui-css', Funcs::asset('widen/plugins/jquery/jquery-ui.css'));
	}

	public function scripts() {
		wp_enqueue_media();
		wp_enqueue_script(Funcs::config('app.short_name') . '-backend', Funcs::asset('/ts/web/admin-pages/admin.min.js'), [
			'jquery', 'jquery-ui-datepicker'
		]);
	}

	public function localizeScripts() {}

}