<?php
namespace WPSP\routes;

use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AjaxsRouteTrait;
use WPSP\Funcs;
use WPSP\app\Http\Controllers\AjaxsController;
use WPSP\app\Http\Middleware\EditorCapability;

class Ajaxs extends BaseRoute {

	use InstancesTrait, AjaxsRouteTrait;

	/*
	 *
	 */

	public function ajaxs() {
		$this->prefix('admin')->name('admin.')->group(function() {
			$this->prefix('database')->name('database.')->group(function() {
				$this->post('handle', [AjaxsController::class, 'handleDatabase'])
					->name('handle')
					->middleware([AdministratorCapability::class]);
			});
		});

		$this->prefix('demo')->name('demo.')->group(function() {
			$this->get('get', [AjaxsController::class, 'ajaxDemoGet'])
				->name('get')
				->middleware([EditorCapability::class]);
		});


		$this->post('wpsp_handle_database', [AjaxsController::class, 'handleDatabase'], false, true, null, [
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle']
		])->name('xxx');
		$this->get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], true, true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class]
		]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}