<?php
namespace WPSP\App\Instances\Requests;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseRequest;
use WPSPCORE\Objects\RequestWithValidation;

class Request extends BaseRequest {
	use InstancesTrait;

	/**
	 * @return RequestWithValidation
	 */
	public static function createFromGlobals() {
		$request             = RequestWithValidation::createFromGlobals();
		$request->validation = Funcs::instance()->getValidation();
		return $request;
	}
}