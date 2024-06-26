<?php

namespace WPSP\routes;

use WPSP\Funcs;
use WPSP\app\Http\Controllers\ApiController;
use WPSP\app\Http\Middleware\ApiAuthentication;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ApiRouteTrait;

class ApiRoute extends BaseRoute {

	use ApiRouteTrait;

	/*
	 *
	 */

	public function __construct() {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		parent::__construct();
	}

	/*
	 *
	 */

	public function apis(): void {
		$this->get('wpsp', [ApiController::class, 'wpsp'], true, null, [
//			[ApiAuthentication::class, 'handle'],
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