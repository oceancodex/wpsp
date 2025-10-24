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
		$this->prefix('post-type')->name('post-type.')->group(function () {
//			$this->prefix('post')->name('post.')->group(function () {
//				$this->prefix('publish')->name('publish.')->group(function () {
					$this->get('list', [wpsp_tab_dashboard::class, 'index'])
						->name('list')
						->middleware([
							[AdministratorCapability::class, 'handle']
						]);
//
//					$this->post('update', [wpsp_tab_dashboard::class, 'index'])
//						->name('update')
//						->middleware([[AdministratorCapability::class, 'handle']]);
//				})->middleware([[AdministratorCapability::class, 'handle']]);
//			})->middleware([[AdministratorCapability::class, 'handle']]);
		})->middleware([
			'relation' => 'OR',
			[EditorCapability::class, 'handle'],
		]);

//		$this->name('page-type.')->group(function () {
//			$this->name('template.')->group(function () {
//				$this->name('publish.')->group(function () {
//					$this->get('wpsp&page=template', [wpsp_tab_dashboard::class, 'index'])
//						->name('list')
//						->middleware([[AdministratorCapability::class, 'handle']]);
//
//					$this->post('wpsp&page=template', [wpsp_tab_dashboard::class, 'index'])
//						->name('update')
//						->middleware([[AdministratorCapability::class, 'handle']]);
//				})->middleware([[AdministratorCapability::class, 'handle']]);
//			})->middleware([[AdministratorCapability::class, 'handle']]);
//		})->middleware([[EditorCapability::class, 'handle']]);

		$this->name('wpsp.')->group(function() {
			$this->get('wpsp', [wpsp::class, 'index'], true)->name('index');
			$this->post('wpsp', [wpsp::class, 'update'], true)->name('update');

			$this->get('wpsp&tab=dashboard', [wpsp_tab_dashboard::class, 'index'], true);

			$this->get('wpsp&tab=license', [wpsp_tab_license::class, 'index'], true, null)->middleware([[AdministratorCapability::class, 'handle']]);
			$this->post('wpsp&tab=license', [wpsp_tab_license::class, 'update'], true);

			$this->get('wpsp&tab=database', [wpsp_tab_database::class, 'index'], true);

			$this->get('wpsp&tab=settings', [wpsp_tab_settings::class, 'index'], true);
			$this->post('wpsp&tab=settings', [wpsp_tab_settings::class, 'update'], true);

			$this->get('wpsp&tab=tools', [wpsp_tab_tools::class, 'index'], true);

			$this->get('wpsp&tab=table', [wpsp_tab_table::class, 'index'], true);
			$this->post('wpsp&tab=table', [wpsp_tab_table::class, 'update'], true);

			$this->get('wpsp&tab=roles', [wpsp_tab_roles::class, 'index'], true);
			$this->post('wpsp&tab=roles', [wpsp_tab_roles::class, 'update'], true);
			$this->get('wpsp&tab=roles&action=refresh', [wpsp_tab_roles::class, 'refresh'], true);

			$this->get('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'index'], true);
			$this->post('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'update'], true);

			$this->get('wpsp&tab=users', [wpsp_tab_users::class, 'index'], true);
			$this->post('wpsp&tab=users', [wpsp_tab_users::class, 'update'], true);

			$this->get('wpsp_child_example', [wpsp_child_example::class, 'index'], true);

			$this->get('edit.php?post_type=wpsp_content', [wpsp_child_post_type_wpsp_content::class, null], true);
			$this->get('edit-tags.php?taxonomy=wpsp_category', [wpsp_child_taxonomy_wpsp_category::class, null], true);
		})->middleware([
			'relation' => 'OR',
			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}