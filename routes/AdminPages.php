<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AdminPagesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\AdminPages\wpsp as AdminPage_wpsp;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_dashboard as AdminPage_wpsp_tab_dashboard;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_license as AdminPage_wpsp_tab_license;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_database as AdminPage_wpsp_tab_database;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_settings as AdminPage_wpsp_tab_settings;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_tools as AdminPage_wpsp_tab_tools;
use WPSP\app\Extend\Components\AdminPages\wpsp_tab_table as AdminPage_wpsp_tab_table;
use WPSP\app\Extend\Components\AdminPages\wpsp_child_example as AdminPage_wpsp_child_example;

class AdminPages extends BaseRoute {

	use AdminPagesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function admin_pages(): void {
		$this->group(function() {
			$this->get('wpsp', [AdminPage_wpsp::class, 'init'], true);
			$this->post('wpsp', [AdminPage_wpsp::class, 'update'], true);
			$this->get('wpsp&tab=dashboard', [AdminPage_wpsp_tab_dashboard::class, 'init'], true);
			$this->get('wpsp&tab=license', [AdminPage_wpsp_tab_license::class, 'init'], true);
			$this->get('wpsp&tab=database', [AdminPage_wpsp_tab_database::class, 'init'], true);
			$this->get('wpsp&tab=settings', [AdminPage_wpsp_tab_settings::class, 'init'], true);
			$this->get('wpsp&tab=tools', [AdminPage_wpsp_tab_tools::class, 'init'], true);
			$this->get('wpsp&tab=table', [AdminPage_wpsp_tab_table::class, 'init'], true);
			$this->get('wpsp_child_example', [AdminPage_wpsp_child_example::class, 'init'], true);
		}, [
			'relation' => 'OR',
			[AdministratorCapability::class, 'handle'],
			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}