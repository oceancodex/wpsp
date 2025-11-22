<?php
namespace WPSP\routes;

use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AjaxsRouteTrait;
use WPSP\Funcs;
use WPSP\App\Http\Controllers\AjaxsController;
use WPSP\App\Http\Middleware\EditorCapability;

class Ajaxs extends BaseRoute {

	use InstancesTrait, AjaxsRouteTrait;

	/*
	 *
	 */

	public function ajaxs() {
		$this->post('kdnsd_test', [AjaxsController::class, 'ajaxDemoGet'], false, true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class]
		]);
		$this->name('wpsp.')->middleware([AdministratorCapability::class])->group(function() {
			$this->post('wpsp_handle_database', [AjaxsController::class, 'handleDatabase'])->name('handle_database');
			$this->get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], true)->name('demo_ajax_get');
		});
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