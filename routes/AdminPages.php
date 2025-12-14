<?php

namespace WPSP\routes;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use WPSP\App\Widen\Routes\AdminPages\AdminPages as Route;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_child_example;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_child_post_type_wpsp_content;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_child_taxonomy_wpsp_category;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_dashboard;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_database;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_license;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_permissions;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_roles;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_settings;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_table;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_tools;
use WPSP\App\WordPress\AdminPages\wpsp\wpsp_tab_users;
use WPSPCORE\App\Routes\AdminPages\AdminPagesRouteTrait;

class AdminPages {

	use AdminPagesRouteTrait;

	/*
	 *
	 */

	public function admin_pages() {
		// Custom admin menu page with closure function
//		Route::middleware([
//			'relation' => 'OR',
//			EditorCapability::class,
//			AdministratorCapability::class
//		])->get('wpsp2', function(
//			$page_title = 'WPSP2',
//			$menu_title = 'WPSP2',
//			$capability = 'administrator',
//			$menu_slug = 'wpsp2',
//			$icon_url = null,
//			$position = null
//		) {
//			echo '<h1>Custom admin menu page "wpsp2" with closure function!</h1>';
//		});

		// Admin menu pages with class instances.
		Route::name('wpsp.')->middleware([
			'relation' => 'OR',
			[AdministratorCapability::class, 'handle'],
			[EditorCapability::class, 'handle'],
		])->group(function() {
			Route::get('wpsp', [wpsp::class, 'index'])->name('index');
			Route::get('wpsp&tab=dashboard', [wpsp_tab_dashboard::class, 'index'])->name('dashboard');
			Route::name('license.')->middleware([
				'relation' => 'AND',
				[AdministratorCapability::class, 'handle'],
				[AuthenticationMiddleware::class, 'handle'],
			])->group(function() {
				Route::get('wpsp&tab=license', [wpsp_tab_license::class, 'index'])->name('index');
				Route::middleware(VerifyCsrfToken::class)->post('wpsp&tab=license', [wpsp_tab_license::class, 'update'])->name('update');
			});
			Route::get('wpsp&tab=database', [wpsp_tab_database::class, 'index'])->name('database');
			Route::name('settings.')->middleware([
				'relation' => 'AND',
				[AuthenticationMiddleware::class],
//				TestMiddleware::class
			])->group(function() {
				Route::get('wpsp&tab=settings', [wpsp_tab_settings::class, 'index'])->name('index');
				Route::post('wpsp&tab=settings', [wpsp_tab_settings::class, 'update'])->name('update');
			});
			Route::get('wpsp&tab=tools', [wpsp_tab_tools::class, 'index'])->name('tools');
			Route::name('table.')->group(function() {
				Route::get('wpsp&tab=table', [wpsp_tab_table::class, 'index'])->name('index');
				Route::post('wpsp&tab=table', [wpsp_tab_table::class, 'update'])->name('update');
			});
			Route::name('roles.')->group(function() {
				Route::get('wpsp&tab=roles', [wpsp_tab_roles::class, 'index'])->name('index');
				Route::post('wpsp&tab=roles', [wpsp_tab_roles::class, 'update'])->name('update');
				Route::get('wpsp&tab=roles&action=refresh', [wpsp_tab_roles::class, 'refresh'])->name('refresh');
			});
			Route::name('permissions.')->group(function() {
				Route::get('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'index'])->name('index');
//				Route::post('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'update'])->name('update');
			});
			Route::name('users.')->group(function() {
				Route::get('wpsp&tab=users', [wpsp_tab_users::class, 'index'])->name('list');
				Route::get('wpsp&tab=users&action=create', [wpsp_tab_users::class, 'create'])->name('create');
				Route::post('wpsp&tab=users&action=create', [wpsp_tab_users::class, 'store'])->name('create');
//				Route::get('wpsp&tab=users&action=show&id=(?P<id>\w+)?&abc=(?P<abc>\w+)?', [wpsp_tab_users::class, 'show'])->name('show');
				Route::get('wpsp&tab=users&action=show&user_id={user_id?}', [wpsp_tab_users::class, 'show'])->name('show');
				Route::middleware(AdministratorCapability::class)->get('wpsp&tab=users&action=edit&id=(?P<id>\d+)', [wpsp_tab_users::class, 'edit'])->name('edit');
				Route::middleware(AdministratorCapability::class)->post('wpsp&tab=users&action=edit&id=(?P<id>\d+)', [wpsp_tab_users::class, 'update'])->name('update');
				Route::middleware(AdministratorCapability::class)->get('wpsp&tab=users&action=delete&id=(?P<id>\d+)', [wpsp_tab_users::class, 'delete'])->name('delete');
			});
			Route::get('wpsp_child_example', [wpsp_child_example::class, 'index'])->name('child_example');
			Route::get('edit.php?post_type=wpsp_content', [wpsp_child_post_type_wpsp_content::class, null])->name('list_wpsp_content');
			Route::get('edit-tags.php?taxonomy=wpsp_category', [wpsp_child_taxonomy_wpsp_category::class, null])->name('list_wpsp_category');
		});

		// Custom sub admin menu page with closure function
//		Route::name('wpsp3.')->middleware(null)->group(function() {
//			Route::name('wpsp3-child.')->middleware([])->group(function() {
//				Route::get('wpsp3-child', [wpsp_child_example::class, 'index'])->name('main');
//				Route::get('wpsp3-last-child', function(
//					$is_submenu_page = true,
//					$parent_slug = 'wpsp2',
//					$page_title = 'WPSP3 Last child',
//					$menu_title = 'WPSP3 Last child',
//					$capability = 'administrator',
//					$menu_slug = 'wpsp3-last-child',
//					$icon_url = null,
//					$position = null
//				) {
//					echo '<h1>Custom admin sub menu page "wpsp3-last-child" with closure function!</h1>';
//				})->name('wpsp3-last-child');
//			});
//		});

		// Custom sub admin menu page with closure function
//		Route::middleware(AdministratorCapability::class)->get('wpsp2-child', function(
//			$is_submenu_page = true,
//			$parent_slug = 'wpsp2',
//			$page_title = 'WPSP2 Child',
//			$menu_title = 'WPSP2 Child',
//			$capability = 'administrator',
//			$menu_slug = 'wpsp2-child',
//			$icon_url = null,
//			$position = null
//		) {
//			echo '<h1>Custom admin sub menu page "wpsp2-child" with closure function!</h1>';
//		})->name('wpsp2-child');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}