<?php

namespace WPSP\app\Extras\Instances\Requests;

use WPSP\app\Exceptions\AuthorizationException;
use WPSP\app\Extras\Instances\Validation\Validation;

class FormRequest extends \WPSPCORE\Validation\FormRequest {

	public function afterConstruct() {
		$this->data = $this->extraParams['data'] ?: $this->collectData();
		$this->validation = Validation::init();

		// Prepare data before validation.
		$this->prepareForValidation();
	}

	/*
	 *
	 */

	public function rules() {
		return [];
	}

	protected function getAuthorizationExceptionClass() {
		return AuthorizationException::class;
	}

}