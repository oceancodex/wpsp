<?php

namespace WPSP\routes;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\FrontendMiddleware;
use WPSP\App\Instances\Routes\AdminPages\AdminPages as Route;
use WPSP\App\WP\AdminPages\wpsp;
use WPSP\App\WP\AdminPages\wpsp_child_example;
use WPSP\App\WP\AdminPages\wpsp_child_post_type_wpsp_content;
use WPSP\App\WP\AdminPages\wpsp_child_taxonomy_wpsp_category;
use WPSP\App\WP\AdminPages\wpsp_tab_dashboard;
use WPSP\App\WP\AdminPages\wpsp_tab_database;
use WPSP\App\WP\AdminPages\wpsp_tab_license;
use WPSP\App\WP\AdminPages\wpsp_tab_permissions;
use WPSP\App\WP\AdminPages\wpsp_tab_roles;
use WPSP\App\WP\AdminPages\wpsp_tab_settings;
use WPSP\App\WP\AdminPages\wpsp_tab_table;
use WPSP\App\WP\AdminPages\wpsp_tab_tools;
use WPSP\App\WP\AdminPages\wpsp_tab_users;
use WPSPCORE\Routes\AdminPages\AdminPagesRouteTrait;

class AdminPages {

	use AdminPagesRouteTrait;

	/*
	 *
	 */

	public function admin_pages() {


		// Admin menu pages with class instances.
		Route::name('wpsp.')->middleware([
			'relation' => 'OR',
			[AdministratorCapability::class, 'handle'],
			[EditorCapability::class, 'handle'],
		])->group(function() {
			Route::name('settings.')->middleware([
				'relation' => 'AND',
				AuthenticationMiddleware::class,
				FrontendMiddleware::class
			])->group(function() {
				Route::get('wpsp&tab=settings', [wpsp_tab_settings::class, 'index'])->name('index');
				Route::post('wpsp&tab=settings', [wpsp_tab_settings::class, 'update'])->name('update');
			});
		});

	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}