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
	public $menu_title          = 'Tab: Settings';
//	public $page_title          = 'Tab: Settings';
//	public $first_submenu_title = null;
	public $capability          = 'manage_options';
//	public $menu_slug           = 'wpsp-settings';
	public $icon_url            = 'dashicons-admin-generic';
//	public $position            = 2;
	public $parent_slug         = 'wpsp';

	/**
	 * Parent properties.
	 */
//	public $classes                = null;
	public $isSubmenuPage          = true;
//	public $removeFirstSubmenu     = false;
//	public $urlsMatchCurrentAccess = [];
//	public $urlsMatchHighlightMenu = [];
	public $showScreenOptions      = true;
//	public $screenOptionsKey       = null;

	/**
	 * Custom properties.
	 */
	private $currentTab  = null;
	private $currentPage = null;
//	private $table       = null;

	/*
	 *
	 */

	/**
	 * Tùy biến những thuộc tính chuyên sâu\
	 * hoặc khởi tạo các thuộc tính để tái sử dụng trong toàn bộ class.
	 */
	public function customProperties() {
		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');

		$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.settings')) . ' - ' . Funcs::config('app.name');
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

	public function afterAddAdminPage($adminPage) {}

	public function beforeLoadAdminPage($adminPage) {}

	public function beforeInLoadAdminPage($adminPage) {}

	public function afterInLoadAdminPage($adminPage) {}

	public function afterLoadAdminPage($adminPage) {}

	public function matchedCurrentAccess() {}

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

	public function update(SettingsUpdateRequest $request) {
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

			wp_redirect(Funcs::route('AdminPages', 'wpsp.settings.index', true));
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

	public function styles() {}

	public function scripts() {}

	public function localizeScripts() {}

}