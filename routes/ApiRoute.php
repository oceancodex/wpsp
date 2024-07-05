<?php

namespace WPSP\routes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Controllers\ApiController;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\ApiAuthentication;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ApiRouteTrait;

class ApiRoute extends BaseRoute {

	use ApiRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function apis(): void {
		$this->get('wpsp', [ApiController::class, 'wpsp'], true, null, [
//			'relation' => 'OR',
//			[ApiAuthentication::class, 'handle'],
//			[EditorCapability::class, 'handle']
		], null, null);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters(): void {
//		$this->hook('filter', 'rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, false, null, null, 10, 1);
	}

	public function hooks() {}

}