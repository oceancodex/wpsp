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
		$this->name('wpsp.')->middleware([AdministratorCapability::class])->group(function() {
			$this->post('wpsp_handle_database', [AjaxsController::class, 'handleDatabase'])->name('handle_database');
			$this->get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], true)->name('demo_ajax_get');
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}