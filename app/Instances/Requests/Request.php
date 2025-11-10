<?php
namespace WPSP\app\Workers\Requests;

use WPSP\app\Traits\InstancesTrait;
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