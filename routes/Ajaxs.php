<?php
namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AjaxsRouteTrait;
use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Controllers\AjaxsController;
use WPSP\app\Http\Middleware\EditorCapability;

class Ajaxs extends BaseRoute {

	use AjaxsRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function ajaxs(): void {
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

	public function actions(): void {}

	public function filters(): void {}

}