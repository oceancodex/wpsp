<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\AuthMiddleware;
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

	use AdminPagesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function admin_pages(): void {
		$this->group(function() {
			$this->get('wpsp', [wpsp::class, 'index'], true);
//			$this->post('wpsp', [wpsp::class, 'update'], true);

			$this->get('wpsp&tab=dashboard', [wpsp_tab_dashboard::class, 'index'], true);

			$this->get('wpsp&tab=license', [wpsp_tab_license::class, 'index'], true);
			$this->post('wpsp&tab=license', [wpsp_tab_license::class, 'update'], true);

			$this->get('wpsp&tab=database', [wpsp_tab_database::class, 'index'], true);

			$this->get('wpsp&tab=settings', [wpsp_tab_settings::class, 'index'], true);
			$this->post('wpsp&tab=settings', [wpsp_tab_settings::class, 'update'], true);

			$this->get('wpsp&tab=tools', [wpsp_tab_tools::class, 'index'], true);

			$this->get('wpsp&tab=table', [wpsp_tab_table::class, 'index'], true);
			$this->post('wpsp&tab=table', [wpsp_tab_table::class, 'update'], true);

			$this->get('wpsp&tab=roles', [wpsp_tab_roles::class, 'index'], true);
			$this->post('wpsp&tab=roles', [wpsp_tab_roles::class, 'update'], true);

			$this->get('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'index'], true);
			$this->post('wpsp&tab=permissions', [wpsp_tab_permissions::class, 'update'], true);

			$this->get('wpsp&tab=users', [wpsp_tab_users::class, 'index'], true);
			$this->post('wpsp&tab=users', [wpsp_tab_users::class, 'update'], true);

			$this->get('wpsp_child_example', [wpsp_child_example::class, 'index'], true);

			$this->get('edit.php?post_type=wpsp_content', [wpsp_child_post_type_wpsp_content::class, null], true);
			$this->get('edit-tags.php?taxonomy=wpsp_category', [wpsp_child_taxonomy_wpsp_category::class, null], true);
		}, [
			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle'],
//			[AuthMiddleware::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}