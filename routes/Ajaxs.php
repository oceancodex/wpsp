<?php
namespace WPSP\routes;

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
		$this->post('wpsp_handle_database', [AjaxsController::class, 'handleDatabase'], false, true, null, [
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle']
		]);
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