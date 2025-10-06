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

	public mixed  $menu_title                  = 'WPSP Panel';
//	public mixed  $page_title                  = 'WPSP';
	public mixed  $capability                  = 'edit_posts';
//	public mixed  $menu_slug                   = 'wpsp';
	public mixed  $icon_url                    = 'dashicons-analytics';
	public mixed  $position                    = 2;
//	public mixed  $parent_slug                 = 'options-general.php';
//	public mixed  $is_submenu_page             = false;
	public mixed  $remove_first_submenu        = true;
//	public ?array $urls_highlight_current_menu = null;
	public mixed  $custom_properties           = null;
	public mixed  $callback_function           = null;

	private mixed $checkDatabase               = null;
	private mixed $table                       = null;
	private mixed $currentTab                  = null;
	private mixed $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->menu_title                  = '';
//		$this->page_title                  = '';
//		$this->capability                  = '';
//		$this->menu_slug                   = '';
//		$this->icon_url                    = '';
//		$this->position                    = '';
//		$this->parent_slug                 = '';
//	    $this->callback_index              = false;
//		$this->is_submenu_page             = true;
//	    $this->remove_first_submenu        = false;
//		$this->urls_highlight_current_menu = [];

		$this->currentTab  = $this->request->get('tab');
		$this->currentPage = $this->request->get('page');
		if (class_exists('\WPSPCORE\Translation\Translator')) {
			$this->page_title = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name');
		}
		else {
			$pageTitle = $this->currentTab ?? 'Dashboard';
			$this->page_title = Funcs::trans(ucfirst($pageTitle), true);
		}
	}

	/*
	 *
	 */

//	public function init($path = null): void {
//		// You must call to parent method "init" if you want to custom it.
//		parent::init();
//
//      // Your code here...
//	}

	public function beforeInit(): void {}

	public function afterInit(): void {
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

	public function afterLoad($adminPage): void {
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

	public function screenOptions($adminPage): void {
		if ($this->request->get('tab') == 'table') {
			parent::screenOptions($adminPage);
		}
	}

	/*
	 *
	 */

	public function index(): void {
		$updated = $this->request->get('updated') ?? null;

		if ($updated && $this->parent_slug !== 'options-general.php' && $this->request->get('tab') !== 'table') {
			if ($updated == 'refresh-custom-roles') {
				Funcs::notice(
					Funcs::trans('Refresh all custom roles successfully', true),
					'success',
					!class_exists('\WPSPCORE\View\Blade'
					)
				);
			}
			else {
				Funcs::notice(
					Funcs::trans('Updated successfully', true),
					'success',
					!class_exists('\WPSPCORE\View\Blade'
					)
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

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {
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

	public function scripts(): void {
		wp_enqueue_script(
			Funcs::config('app.short_name') . '-database',
			Funcs::instance()->_getPublicUrl() . '/js/modules/web/admin-pages/wpsp/Database.min.js',
			null,
			Funcs::instance()->_getVersion(),
			true
		);
	}

	public function localizeScripts(): void {
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