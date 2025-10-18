<?php

namespace WPSP\app\Extras\Components\AdminPages;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extras\Components\License\License;
use WPSP\app\Extras\Instances\Cache\Cache;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Models\SettingsModel;
use WPSP\app\Models\UsersModel;
use WPSP\app\Models\VideosModel;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\View\Share;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp extends BaseAdminPage {

	use InstancesTrait;

	public $menu_title                  = 'WPSP Panel';
//	public $page_title                  = 'WPSP';
	public $capability                  = 'read';
//	public $menu_slug                   = 'wpsp';
	public $icon_url                    = 'dashicons-analytics';
	public $position                    = 2;
//	public $parent_slug                 = 'options-general.php';
//	public $is_submenu_page             = false;
	public $remove_first_submenu        = true;
//	public $urls_highlight_current_menu = null;
	public $callback_function           = null;

	protected $screen_options           = null;
	protected $screen_options_key       = null;

	private $checkDatabase              = null;
	private $table                      = null;
	private $currentTab                 = null;
	private $currentPage                = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
		if (class_exists('\WPSPCORE\Translation\Translator')) {
			$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');
		}
		else {
			$pageTitle = $this->currentTab ?? 'Dashboard';
			$this->page_title = Funcs::trans(ucfirst($pageTitle), true);
		}
		$this->screen_options_key = $this->getQueryStringSlugify(['page', 'tab']);
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
		try {
			if ($this->currentPage == $this->menu_slug) {
				// Check database version and maybe redirect.
				$this->checkDatabase = Funcs::instance()->_getAppMigration()->checkDatabaseVersion();
				if (empty($this->checkDatabase['result']) && $this->currentPage == $this->getMenuSlug() && $this->currentTab !== 'database') {
					$url = Funcs::instance()->_buildUrl($this->getParentSlug(), [
						'page' => $this->getMenuSlug(),
						'tab'  => 'database',
					]);
					wp_redirect($url);
				}
			}
		}
		catch (\Exception|\Throwable $e) {
			Funcs::debug($e->getMessage());
		}
	}

	public function afterLoad($adminPage) {
		if (in_array($this->request->get('tab'), ['table'])) {
			$this->table = new \WPSP\app\Extras\Components\ListTables\Settings();
		}
		elseif (in_array($this->request->get('tab'), ['roles'])) {
			$this->table = new \WPSP\app\Extras\Components\ListTables\Roles();
//			$this->table = new \WPSP\app\Extras\Components\ListTables\WPRoles();
		}
		elseif (in_array($this->request->get('tab'), ['permissions'])) {
			$this->table = new \WPSP\app\Extras\Components\ListTables\Permissions();
//			$this->table = new \WPSP\app\Extras\Components\ListTables\WPCapabilities();
		}
		elseif (in_array($this->request->get('tab'), ['users'])) {
			$this->table = new \WPSP\app\Extras\Components\ListTables\Users();
		}
	}

//	public function screenOptions($adminPage) {
//		if ($this->request->get('tab') == 'table') {
//			parent::screenOptions($adminPage);
//		}
//	}

	/*
	 *
	 */

	public function index() {
		$updated = $this->request->get('updated') ?? null;

		if ($updated && $this->parent_slug !== 'options-general.php' && $this->request->get('tab') !== 'table') {
			if ($updated == 'refresh-custom-roles') {
				Funcs::notice(
					Funcs::trans('Refresh all custom roles successfully', true),
					'success',
					!class_exists('\WPSPCORE\View\Blade')
				);
			}
			else {
				Funcs::notice(
					Funcs::trans('Updated successfully', true),
					'success',
					!class_exists('\WPSPCORE\View\Blade')
				);
			}
		}

		$requestParams = $this->request->query->all();
		$menuSlug      = $this->getMenuSlug();

		try {
//		    $checkLicense  = License::checkLicense();

			// Test cache.
//			$cacheTest = Cache::get('cache-test', function(ItemInterface $item) {
//				$item->expiresAfter(60);
//				return 'This is a cached value';
//			});
//			echo '<pre style="z-index: 9999; position: relative; clear: both;">'; print_r($cacheTest); echo '</pre>';

			$table = $this->table;

			echo Funcs::view('modules.admin-pages.wpsp.main', compact(
				'requestParams',
				'menuSlug',
//			    'checkLicense',
				'table'
			))->with([
				'checkDatabase' => $this->checkDatabase,
			]);
		}
		catch (\Exception|\Throwable $e) {
			Funcs::notice($e->getMessage() . ' <code>(' . __CLASS__ . ')</code>', 'error', true, true);

			$user          = wp_get_current_user();
			$settings      = Share::instance()->variables()['settings'] ?? null;
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
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts() {
		wp_enqueue_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::instance()->_getPublicUrl() . '/js/modules/web/admin-pages/wpsp/Database.min.js',
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