<?php
namespace WPSP\routes;

use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\AjaxsRouteTrait;
use WPSP\Funcs;
use WPSP\App\Http\Controllers\AjaxsController;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Instances\Routes\AjaxsRoute as Route;

class Ajaxs extends BaseRouter {

	use InstancesTrait, AjaxsRouteTrait;

	/*
	 *
	 */

	public function ajaxs() {
//		$this->middleware(AdministratorCapability::class)->post('test', [AjaxsController::class, 'ajaxDemoGet']);
//
//		$this->name('wpsp.')->middleware([AdministratorCapability::class])->group(function() {
//			$this->middleware(EditorCapability::class)->post('wpsp_handle_database', [AjaxsController::class, 'handleDatabase'])->name('handle_database');
//			$this->get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], true, true)->name('demo_ajax_get');
//		});
//
//		$this->middleware(AdministratorCapability::class)->post('test2', [AjaxsController::class, 'ajaxDemoGet']);
//		$this->middleware(AdministratorCapability::class)->post('test3', [AjaxsController::class, 'ajaxDemoGet']);
//		$this->middleware(AdministratorCapability::class)->post('test4', [AjaxsController::class, 'ajaxDemoGet']);

		Route::middleware(AdministratorCapability::class)->get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], true, true);
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}