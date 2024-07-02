<?php

namespace WPSP\app\Extend\Components\AdminPages;

use WPSP\app\Extend\Components\License\License;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Extend\Instances\Database\Migration;
use WPSP\app\Models\Settings;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp extends BaseAdminPage {

	use InstancesTrait;

	public mixed $menuTitle      = 'WPSP Settings';
//	public mixed $pageTitle      = 'WPSP';
	public mixed $capability     = 'edit_posts';
//	public mixed $menuSlug       = 'wpsp';
	public mixed $iconUrl        = 'dashicons-admin-generic';
	public mixed $position       = 2;
//	public mixed $isSubAdminPage = true;
//	public mixed $parentSlug     = 'options-general.php';

	private mixed $checkDatabase = null;
	private mixed $table         = null;

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->menuTitle      = '';
//		$this->pageTitle      = '';
//		$this->capability     = '';
//		$this->menuSlug       = '';
//		$this->iconUrl        = '';
//		$this->position       = '';
//		$this->isSubAdminPage = false;
//		$this->parentSlug     = '';
	}

	/*
	 *
	 */

	public function init($path = null): void {
		$currentTab  = $this->request->get('tab');
		$currentPage = $this->request->get('page');

		// Custom information before call to parent method "init" .
		$this->setPageTitle(($currentTab ? Funcs::trans('messages.' . $currentTab) : Funcs::trans('messages.dashboard')) . ' - ' . Funcs::config('app.name'));

		// You must call to parent method "init" if you want to custom it.
		parent::init();

		// Check database version and maybe redirect.
		$this->checkDatabase = Migration::instance()->checkDatabaseVersion();
		if (!$this->checkDatabase['result'] && $currentPage == $this->getMenuSlug() && $currentTab !== 'database') {
			$url = Funcs::instance()->_buildUrl($this->getParentSlug(), [
				'page' => $this->getMenuSlug(),
				'tab'  => 'database',
			]);
			wp_redirect($url);
		}
	}

	public function afterLoad($menuPage): void {
		if ($this->request->get('tab') == 'table') {
			$this->table = new \WPSP\app\Extend\Components\ListTables\Settings();
		}
	}

//	public function screenOptions($menuPage): void {
//		parent::screenOptions($menuPage);
//	}

	/*
	 *
	 */

	public function index(): void {
		if ($this->request->get('updated') && $this->parentSlug !== 'options-general.php' && $this->request->get('tab') !== 'table') {
			Funcs::notice(Funcs::trans('Updated successfully'), 'success');
		}

		$requestParams = $this->request->query->all();
		$menuSlug      = $this->getMenuSlug();
		$settings      = Cache::getItemValue('settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null);

		$table = $this->table;

		echo Funcs::view('modules.web.admin-pages.wpsp.main', compact(
			'requestParams',
			'menuSlug',
			'settings',
			'checkLicense',
			'table'
		))->with([
			'checkDatabase' => $this->checkDatabase,
		]);
	}

	public function update(): void {
		$tab = $this->request->get('tab');
		if ($tab !== 'table') {
			$settings = $this->request->get('settings');

			$existSettings = Cache::getItemValue('settings');
			$existSettings = array_merge($existSettings ?? [], $settings ?? []);

			// Save settings into cache.
			Cache::set('settings', function() use ($existSettings) {
				return $existSettings;
			});

			// Delete license information cache.
			Cache::delete('license_information');

			// Save settings into database.
			Settings::updateOrCreate([
				'key' => 'settings',
			], [
				'value' => json_encode($existSettings),
			]);

			wp_safe_redirect(wp_get_raw_referer() . '&updated=true');
		}
	}

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
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-grid.css',
			null,
			Funcs::instance()->_getVersion()
		);
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-utilities.css',
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