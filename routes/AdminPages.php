<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\AuthMiddleware;
use WPSP\app\Http\Middleware\TestMiddleware;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AdminPagesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Components\AdminPages\wpsp;
use WPSP\app\Components\AdminPages\wpsp_tab_dashboard;
use WPSP\app\Components\AdminPages\wpsp_tab_license;
use WPSP\app\Components\AdminPages\wpsp_tab_database;
use WPSP\app\Components\AdminPages\wpsp_tab_settings;
use WPSP\app\Components\AdminPages\wpsp_tab_tools;
use WPSP\app\Components\AdminPages\wpsp_tab_table;
use WPSP\app\Components\AdminPages\wpsp_tab_roles;
use WPSP\app\Components\AdminPages\wpsp_tab_permissions;
use WPSP\app\Components\AdminPages\wpsp_tab_users;
use WPSP\app\Components\AdminPages\wpsp_child_example;
use WPSP\app\Components\AdminPages\wpsp_child_post_type_wpsp_content;
use WPSP\app\Components\AdminPages\wpsp_child_taxonomy_wpsp_category;

class AdminPages extends BaseRoute {

	use InstancesTrait, AdminPagesRouteTrait;

	/*
	 *
	 */

	public function admin_pages() {
		$this->name('wpsp.')->middleware([
			[TestMiddleware::class, 'handle']
		])->group(function() {
			$this->get('wpsp', [wpsp::class, 'index'], true)->name('index');
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}