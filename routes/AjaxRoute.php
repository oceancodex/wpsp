<?php
namespace OCBP\routes;

use OCBPCORE\Base\BaseRoute;
use OCBP\app\Http\Controllers\AjaxController;
use OCBPCORE\Traits\AjaxRouteTrait;

class AjaxRoute extends BaseRoute {

	use AjaxRouteTrait;

	public function apis(): void {
		$this->post('ocbp_handle_database', [AjaxController::class, 'handleDatabase'], false, true, null, [
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle']
		]);

		$this->get('demo_ajax_get', [AjaxController::class, 'demoAjaxGet'], false, true, null, [
//			[AdministratorCapability::class, 'handle']
		]);
	}

}