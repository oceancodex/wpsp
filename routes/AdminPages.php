<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AdminPagesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extends\Components\AdminPages\wpsp;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_dashboard;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_license;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_database;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_settings;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_tools;
use WPSP\app\Extends\Components\AdminPages\wpsp_tab_table;
use WPSP\app\Extends\Components\AdminPages\wpsp_child_example;
use WPSP\app\Extends\Components\AdminPages\wpsp_child_post_type_wpsp_content;
use WPSP\app\Extends\Components\AdminPages\wpsp_child_taxonomy_wpsp_category;

class AdminPages extends BaseRoute {

	use AdminPagesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function admin_pages(): void {
		$this->group(function() {
			$this->get('wpsp', [wpsp::class, 'index'], true);
			$this->post('wpsp', [wpsp::class, 'update'], true);
			$this->get('admin.php?page=wpsp&tab=dashboard', [wpsp_tab_dashboard::class, null], true);
			$this->get('admin.php?page=wpsp&tab=license', [wpsp_tab_license::class, null], true);
			$this->get('admin.php?page=wpsp&tab=database', [wpsp_tab_database::class, null], true);
			$this->get('admin.php?page=wpsp&tab=settings', [wpsp_tab_settings::class, null], true);
			$this->get('admin.php?page=wpsp&tab=tools', [wpsp_tab_tools::class, null], true);
			$this->get('admin.php?page=wpsp&tab=table', [wpsp_tab_table::class, null], true);
			$this->get('wpsp_child_example', [wpsp_child_example::class, 'index'], true);
			$this->get('edit.php?post_type=wpsp_content', [wpsp_child_post_type_wpsp_content::class, null], true);
			$this->get('edit-tags.php?taxonomy=wpsp_category', [wpsp_child_taxonomy_wpsp_category::class, null], true);
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