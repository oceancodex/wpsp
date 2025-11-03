<?php
namespace WPSP\app\Workers\Requests;

use WPSP\app\Workers\Validation\Validation;

class Request extends \WPSPCORE\Base\BaseRequest {
	public static function createFromGlobals() {
		$request             = \WPSPCORE\Validation\RequestWithValidation::createFromGlobals();
		$request->validation = Validation::instance();
		return $request;
	}
}