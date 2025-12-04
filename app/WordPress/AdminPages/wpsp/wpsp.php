<?php

namespace WPSP\App\WordPress\AdminPages\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Instances\Database\Migration;
use WPSP\App\Instances\InstancesTrait;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPages\BaseAdminPage;

class wpsp extends BaseAdminPage {

	use InstancesTrait;

	/**
	 * WordPress admin page properties.
	 */
	public $menu_title                  = 'WPSP Panel';
//	public $page_title                  = 'WPSP';                   // Thẻ <title> trong HTML.
//	public $first_submenu_title         = 'Dashboard';              // Khi có nhiều submenu, WordPress sẽ tự sinh submenu cho trang chính. Thay đổi tên submenu tự sinh.
	public $capability                  = 'read';
//	public $menu_slug                   = 'wpsp';
	public $icon_url                    = 'dashicons-analytics';
	public $position                    = 2;
//	public $parent_slug                 = 'options-general.php';
//	public $is_submenu_page             = false;
	public $remove_first_submenu        = true;
//	public $urls_highlight_current_menu = null;
//	public $callback_function           = null;

	/**
	 * Parent properties.
	 */
//	protected $screen_options           = null;
//	protected $screen_options_key       = null;

	/**
	 * Custom properties.
	 */
	private $currentTab                 = null;
	private $currentPage                = null;
	private $checkDatabase              = null;
//	private $table                      = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');

		$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');

		$this->screen_options_key = $this->funcs->_slugParams(['page', 'tab']);
		if (in_array($this->currentTab, ['table', 'roles', 'permissions', 'users'])) {
			$this->screen_options = true;
		}
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
		// Custom highlight current menu.
//		if (preg_match('/' . $this->menu_slug . '$|' . $this->menu_slug . '&updated=true$/', $this->request->getRequestUri())) {
//			add_filter('submenu_file', function($submenu_file) {
//				return $this->menu_slug;
//			});
//		}

		// Redirect to the "Database" tab if database version not valid.
//		try {
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
//		}
//		catch (\Throwable $e) {
//			Funcs::notice($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 'error');
//		}
	}

	public function afterLoadAdminPage($adminPage) {
		if (in_array($this->currentTab, ['table'])) {
			$this->table = new \WPSP\App\WordPress\ListTables\Settings();
		}
		elseif (in_array($this->currentTab, ['roles'])) {
			$this->table = new \WPSP\App\WordPress\ListTables\Roles();
//			$this->table = new \WPSP\App\WordPress\ListTables\WPRoles();
		}
		elseif (in_array($this->currentTab, ['permissions'])) {
			$this->table = new \WPSP\App\WordPress\ListTables\Permissions();
//			$this->table = new \WPSP\App\WordPress\ListTables\WPCapabilities();
		}
		elseif (in_array($this->currentTab, ['users'])) {
			$this->table = new \WPSP\App\WordPress\ListTables\Users();
		}
	}

//	public function screenOptions($adminPage) {
//		if ($this->currentTab == 'table') {
//			parent::screenOptions($adminPage);
//		}
//	}

	/*
	 *
	 */

	public function index(Request $request) {
		$requestParams = $request->all();
		$menuSlug      = $this->menu_slug;

		$settings = SettingsModel::query()->where('key', 'settings')->pluck('value')->first();
		$settings = json_decode($settings ?? '', true);

		try {
//		    $checkLicense  = License::checkLicense();

			$table = $this->table;
			echo Funcs::view('modules.admin-pages.wpsp.main', compact(
				'requestParams',
				'menuSlug',
//			    'checkLicense',
				'settings',
				'table'
			))->with([
				'checkDatabase' => $this->checkDatabase,
			]);
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage() . ' <code>(' . __CLASS__ . ')</code>', 'error', true, true);

			$user          = wp_get_current_user();
			$checkDatabase = $this->checkDatabase;
			$funcs         = Funcs::instance();

			include(Funcs::instance()->_getResourcesPath('/views/modules/admin-pages/wpsp/main.php'));
		}
	}

	public function update() {}

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
			Funcs::instance()->_getPublicUrl() . '/extras/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/extras/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts() {
		wp_enqueue_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::instance()->_getPublicUrl() . '/ts/modules/web/admin-pages/wpsp/Database.min.js',
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