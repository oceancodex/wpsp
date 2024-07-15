<?php
namespace WPSP\routes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Controllers\AjaxController;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\AjaxRouteTrait;

class AjaxRoute extends BaseRoute {

	use AjaxRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function apis(): void {
		$this->post('wpsp_handle_database', [AjaxController::class, 'handleDatabase'], false, true, null, [
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle']
		]);
		$this->get('demo_ajax_get', [AjaxController::class, 'ajaxDemoGet'], true, true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class]
		]);
	}

}