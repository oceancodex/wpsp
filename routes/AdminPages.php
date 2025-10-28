<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\AuthMiddleware;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AdminPagesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\AdminPages\wpsp;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_dashboard;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_license;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_database;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_settings;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_tools;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_table;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_roles;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_permissions;
use WPSP\app\Extras\Components\AdminPages\wpsp_tab_users;
use WPSP\app\Extras\Components\AdminPages\wpsp_child_example;
use WPSP\app\Extras\Components\AdminPages\wpsp_child_post_type_wpsp_content;
use WPSP\app\Extras\Components\AdminPages\wpsp_child_taxonomy_wpsp_category;

class AdminPages extends BaseRoute {

	use InstancesTrait, AdminPagesRouteTrait;

	/*
	 *
	 */

	public function admin_pages() {

		// Custom admin menu page with closure function
//		$this->middleware(['relation' => 'OR', EditorCapability::class, AdministratorCapability::class])
//			->get('wpsp2', function($page_title = 'WPSP2', $menu_title = 'WPSP2', $capability = 'administrator', $menu_slug = 'wpsp2', $icon_url = null, $position = null) {
//			echo 'Custom admin menu page with closure function: WPSP';
//		}, true);

		// Admin menu pages with class instances.
		$this->name('wpsp.')->middleware([
			[AdministratorCapability::class, 'handle']
		])->group(function() {
			$this->get('wpsp', [wpsp::class, 'index'], true)->name('index');
			$this->post('wpsp', [wpsp::class, 'update'], true)->name('update');
			$this->get('wpsp&tab=dashboard', [wpsp_tab_dashboard::class, 'index'], true)->name('dashboard');
			$this->name('license.')->middleware([
				'relation' => 'OR',
				[AdministratorCapability::class, 'handle'],
				[EditorCapability::class, 'handle']
			])->group(function() {
				$this->get('wpsp&tab=license', [wpsp_tab_license::class, 'index'], true)->name('index');
				$this->post('wpsp&tab=license', [wpsp_tab_license::class, 'update'], true)->name('update');
			});
			$this->get('wpsp&tab=database', [wpsp_tab_database::class, 'index'], true)->name('database');
			$this->name('settings.')->group(function() {
				$this->get('wpsp&tab=settings', [wpsp_tab_settings::class, 'index'], true)->name('index');
				$this->post('wpsp&tab=settings', [wpsp_tab_settings::class, 'update'], true)->name('update');
			});
			$this->get('wpsp&tab=tools', [wpsp_tab_tools::class, 'index'], true)->name('tools');
			$this->name('table.')->group(function() {
				$this->get('wpsp&tab=table', [wpsp_tab_table::class, 'index'], true)->name('index');
				$this->post('wpsp&tab=table', [wpsp_tab_table::class, 'update'], true)->name('update');
			});
			$this->name('roles.')->group(function() {
				$this->get('wpsp&tab=roles', [wpsp_tab_roles::class, 'index'], true)->name('index');
				$this->post('wpsp&tab=roles', [wpsp_tab_roles::class, 'update'], true)->name('update');
				$this->get('wpsp&tab=roles&action=refresh', [wpsp_tab_roles::class, 'refresh'], true)->name('refresh');
			});
			$this->name('permissions.')->group(function() {
				$this->get('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'index'], true)->name('index');
				$this->post('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'update'], true)->name('update');
			});
			$this->name('users.')->group(function() {
				$this->get('wpsp&tab=users', [wpsp_tab_users::class, 'index'], true)->name('list');
				$this->get('wpsp&tab=users&action=create', [wpsp_tab_users::class, 'create'], true)->name('create');
				$this->post('wpsp&tab=users&action=create', [wpsp_tab_users::class, 'create'], true)->name('create');
				$this->get('wpsp&tab=users&action=show&id=(?P<id>\d+)', [wpsp_tab_users::class, 'show'], true)->name('show');
				$this->middleware(AdministratorCapability::class)->get('wpsp&tab=users&action=edit&id=(?P<id>\d+)', [wpsp_tab_users::class, 'edit'], true)->name('edit');
				$this->middleware([AdministratorCapability::class])->post('wpsp&tab=users&action=edit&id=(?P<id>\d+)', [wpsp_tab_users::class, 'update'], true)->name('update');
				$this->middleware(AdministratorCapability::class)->get('wpsp&tab=users&action=delete&id=(?P<id>\d+)', [wpsp_tab_users::class, 'delete'], true)->name('delete');
			});
			$this->get('wpsp_child_example', [wpsp_child_example::class, 'index'], true)->name('child_example');
			$this->get('edit.php?post_type=wpsp_content', [wpsp_child_post_type_wpsp_content::class, null], true)->name('list_wpsp_content');
			$this->get('edit-tags.php?taxonomy=wpsp_category', [wpsp_child_taxonomy_wpsp_category::class, null], true)->name('list_wpsp_category');
		});

		// Custom sub admin menu page with closure function
//		$this->name('wpsp3.')->middleware(null)->group(function() {
//			$this->name('wpsp3-child.')->middleware([])->group(function() {
//				$this->get('wpsp3-child', [wpsp_child_example::class, 'index'], true)->name('main');
//				$this->get('wpsp3-last-child', function(
//					$is_submenu_page = true, $parent_slug = 'wpsp2', $page_title = 'WPSP3 Last child', $menu_title = 'WPSP3 Last child',
//					$capability = 'administrator', $menu_slug = 'wpsp3-last-child', $icon_url = null, $position = null
//				) {
//					echo 'Custom admin sub menu page with closure function: WPSP3 Last child';
//				}, true)->name('wpsp3-last-child');
//			});
//		});

		// Custom sub admin menu page with closure function
//		$this->middleware(AdministratorCapability::class)->get('wpsp2-child', function(
//			$is_submenu_page = true, $parent_slug = 'wpsp2', $page_title = 'WPSP2 Child', $menu_title = 'WPSP2 Child',
//			$capability = 'administrator', $menu_slug = 'wpsp2-child', $icon_url = null, $position = null
//		) {
//			echo 'Custom admin sub menu page with closure function: WPSP Child';
//		}, true)->name('wpsp2-child');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}