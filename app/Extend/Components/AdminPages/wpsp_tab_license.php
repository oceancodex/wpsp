<?php

namespace WPSP\app\Extend\Components\AdminPages;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseAdminPage;

class wpsp_tab_license extends BaseAdminPage {

	use InstancesTrait;

	public mixed  $menu_title                  = 'Tab: License';
//	public mixed  $page_title                  = 'Tab: License';
	public mixed  $capability                  = 'manage_options';
//	public mixed  $menu_slug                   = 'wpsp&tab=license';
	public mixed  $icon_url                    = 'dashicons-admin-generic';
//	public mixed  $position                    = 2;
	public mixed  $parent_slug                 = 'wpsp';
//	public mixed  $callback_index              = true;
	public mixed  $is_submenu_page             = true;
//	public mixed  $remove_first_submenu        = false;
//	public ?array $urls_highlight_current_menu = null;

//	private mixed $checkDatabase               = null;
//	private mixed $table                       = null;
	private mixed $currentTab                  = null;
	private mixed $currentPage                 = null;

	/*
	 *
	 */

	public function customProperties(): void {
		$this->currentTab   = $this->request->get('tab');
		$this->currentPage  = $this->request->get('page');
		$this->page_title   = ($this->currentTab ? Funcs::trans('messages.' . $this->currentTab) : Funcs::trans('messages.license')) . ' - ' . Funcs::config('app.name');
	}

	/*
	 *
	 */

//	public function init($path = null): void {}

	public function beforeInit(): void {}

	public function afterInit(): void {}

	public function afterLoad($adminPage): void {}

//	public function screenOptions($adminPage): void {}

	/*
	 *
	 */

	public function index(): void {}

	public function update(): void {}

	/*
	 *
	 */

	public function styles(): void {}

	public function scripts(): void {}

	public function localizeScripts(): void {}

}