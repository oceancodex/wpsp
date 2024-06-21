<?php

namespace OCBP\app\Components\AdminPages;

use OCBPCORE\Base\BaseAdminPage;
use OCBP\app\Components\License\License;
use OCBPCORE\Objects\Cache\Cache;
use OCBPCORE\Objects\Database\Migration;
use OCBP\app\Models\Settings;

class ocbp extends BaseAdminPage {

	public mixed $menuTitle      = 'OCBP Settings';
//	public mixed $pageTitle      = 'OCBP';
	public mixed $capability     = 'edit_posts';
//	public mixed $menuSlug       = 'ocbp';
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
		$this->setPageTitle(($currentTab ? trans('messages.' . $currentTab) : trans('messages.dashboard')) . ' - ' . config('app.name'));

		// You must call to parent method "init" if you want to custom it.
		parent::init();

		// Check database version and maybe redirect.
		$this->checkDatabase = Migration::checkDatabaseVersion();
		if (!$this->checkDatabase['result'] && $currentPage == $this->getMenuSlug() && $currentTab !== 'database') {
			$url = _build_url($this->getParentSlug(), [
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
			_notice(trans('Updated successfully'), 'success');
		}

		$appShortName  = config('app.short_name');
		$requestParams = self::$request->query->all();
		$menuSlug      = $this->getMenuSlug();
		$settings      = Cache::getItemValue($appShortName . '_settings');
		$checkLicense  = License::checkLicense($settings['license_key'] ?? null);

		echo view('modules.web.admin-pages.ocbp.main', compact(
			'requestParams',
			'menuSlug',
			'settings',
			'checkLicense'
		))->with([
			'checkDatabase' => $this->checkDatabase,
		]);
	}

	public function update(): void {
		$appShortName = config('app.short_name');
		$settings     = self::$request->get($appShortName . '_settings');

		$existSettings = Cache::getItemValue($appShortName . '_settings');
		$existSettings = array_merge($existSettings ?? [], $settings ?? []);

		// Save settings into cache.
		Cache::set($appShortName . '_settings', function() use ($existSettings) {
			return $existSettings;
		});

		// Delete license information cache.
		Cache::delete(config('app.short_name') . '_license_information');

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
		wp_enqueue_style(config('app.short_name') . '-admin', OCBP_PUBLIC_URL . '/css/admin.min.css', null, OCBP_VERSION);
		wp_enqueue_style(config('app.short_name') . '-bootstrap-grid', OCBP_PUBLIC_URL . '/plugins/bootstrap/css/bootstrap-grid.css', null, OCBP_VERSION);
//		wp_enqueue_style(config('app.short_name') . '-bootstrap-buttons', OCBP_PUBLIC_URL . '/plugins/bootstrap/css/bootstrap-buttons.css', null, OCBP_VERSION);
		wp_enqueue_style(config('app.short_name') . '-bootstrap-utilities', OCBP_PUBLIC_URL . '/plugins/bootstrap/css/bootstrap-utilities.css', null, OCBP_VERSION);
	}

	public function scripts(): void {
		wp_enqueue_script(config('app.short_name') . '-database', OCBP_PUBLIC_URL . '/js/modules/web/admin-pages/ocbp/Database.min.js', null, OCBP_VERSION, true);
	}

	public function localizeScripts(): void {
		wp_localize_script(config('app.short_name') . '-database', config('app.short_name') . '_localize', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce(config('app.short_name')),
			'public_url' => OCBP_PUBLIC_URL,
		]);
	}

}