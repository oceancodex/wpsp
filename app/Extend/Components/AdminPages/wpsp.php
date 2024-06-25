<?php

namespace WPSP\app\Extend\Components\AdminPages;

use WPSP\app\Extend\Database\Migration;
use WPSPCORE\Cache\Cache;
use WPSP\app\Extend\Components\License\License;
use WPSP\app\Models\Settings;
use WPSPCORE\Base\BaseAdminPage;
use WPSP\Funcs;

class wpsp extends BaseAdminPage {

	public mixed $menuTitle      = 'WPSP Settings';
//	public mixed $pageTitle      = 'WPSP';
	public mixed $capability     = 'edit_posts';
//	public mixed $menuSlug       = 'wpsp';
	public mixed $iconUrl        = 'dashicons-admin-generic';
	public mixed $position       = 2;
	public mixed $isSubAdminPage = true;
	public mixed $parentSlug     = 'options-general.php';

	public mixed $checkDatabase  = null;

	/*
	 *
	 */

	public function init($path = null): void {
		$currentTab  = self::$request->get('tab');
		$currentPage = self::$request->get('page');

		// Custom information before call to parent method "init" .
		$this->setPageTitle(($currentTab ? Funcs::instance()->trans('messages.' . $currentTab) : Funcs::instance()->trans('messages.dashboard')) . ' - ' . Funcs::instance()->config('app.name'));

		// You must call to parent method "init" if you want to custom it.
		parent::init();

		// Check database version and maybe redirect.
		$this->checkDatabase = Migration::instance()->checkDatabaseVersion();
		if (!$this->checkDatabase['result'] && $currentPage == $this->getMenuSlug() && $currentTab !== 'database') {
			$url = Funcs::instance()->buildUrl($this->getParentSlug(), [
				'page' => $this->getMenuSlug(),
				'tab'  => 'database',
			]);
			wp_redirect($url);
		}
	}

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

	public function index(): void {
		if (self::$request->get('updated') && $this->parentSlug !== 'options-general.php') {
			Funcs::instance()->notice(Funcs::instance()->trans('Updated successfully'), 'success');
		}

		$appShortName  = Funcs::instance()->config('app.short_name');
		$requestParams = self::$request->query->all();
		$menuSlug      = $this->getMenuSlug();
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null);

		echo Funcs::instance()->view('modules.web.admin-pages.wpsp.main', compact(
			'requestParams',
			'menuSlug',
			'settings',
			'checkLicense'
		))->with([
			'checkDatabase' => $this->checkDatabase,
		]);
	}

	public function update(): void {
		$appShortName = Funcs::instance()->config('app.short_name');
		$settings     = self::$request->get($appShortName . '_settings');

		$existSettings = Cache::getItemValue($appShortName . '_settings');
		$existSettings = array_merge($existSettings ?? [], $settings ?? []);

		// Save settings into cache.
		Cache::set($appShortName . '_settings', function() use ($existSettings) {
			return $existSettings;
		});

		// Delete license information cache.
		Cache::delete(Funcs::instance()->config('app.short_name') . '_license_information');

		// Save settings into database.
		Settings::updateOrCreate([
			'key' => 'settings',
		], [
			'value' => json_encode($existSettings),
		]);

		wp_safe_redirect(wp_get_raw_referer() . '&updated=true');
	}

	/*
	 *
	 */

	public function styles(): void {
		wp_enqueue_style(
			Funcs::instance()->config('app.short_name') . '-admin',
			Funcs::instance()->getPublicUrl() . '/css/admin.min.css',
			null, Funcs::instance()->getVersion()
		);
		wp_enqueue_style(
			Funcs::instance()->config('app.short_name') . '-bootstrap-grid',
			Funcs::instance()->getPublicUrl() . '/plugins/bootstrap/css/bootstrap-grid.css',
			null,
			Funcs::instance()->getVersion()
		);
//		wp_enqueue_style(config('app.short_name') . '-bootstrap-buttons', WPSP_PUBLIC_URL . '/plugins/bootstrap/css/bootstrap-buttons.css', null, WPSP_VERSION);
		wp_enqueue_style(
			Funcs::instance()->config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->getPublicUrl() . '/plugins/bootstrap/css/bootstrap-utilities.css',
			null,
			Funcs::instance()->getVersion()
		);
	}

	public function scripts(): void {
		wp_enqueue_script(
			Funcs::instance()->config('app.short_name') . '-database',
			Funcs::instance()->getPublicUrl() . '/js/modules/web/admin-pages/wpsp/Database.min.js',
			null,
			Funcs::instance()->getVersion(),
			true
		);
	}

	public function localizeScripts(): void {
		wp_localize_script(
			Funcs::instance()->config('app.short_name') . '-database',
			Funcs::instance()->config('app.short_name') . '_localize',
			[
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce(Funcs::instance()->config('app.short_name')),
			'public_url' => Funcs::instance()->getPublicUrl(),
		]
		);
	}

}