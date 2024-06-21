<?php

namespace OCBP\routes;

use OCBPCORE\Base\BaseRoute;
use OCBP\app\Http\Controllers\ApiController;
use OCBP\app\Http\Middleware\ApiAuthentication;
use OCBPCORE\Traits\ApiRouteTrait;

class ApiRoute extends BaseRoute {

	use ApiRouteTrait;

	public function apis(): void {
		$this->get('ocbp', [ApiController::class, 'ocbp'], true, null, [
			[ApiAuthentication::class, 'handle'],
		], null, null);
	}

	public function actions() {}

	public function filters(): void {
//		$this->hook('filter', 'rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, false, null, null, 10, 1);
	}

	public function hooks() {}

}