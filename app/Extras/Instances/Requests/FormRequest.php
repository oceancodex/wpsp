<?php

namespace WPSP\app\Extras\Instances\Requests;

use WPSP\app\Exceptions\AuthorizationException;
use WPSP\app\Extras\Instances\Validation\Validation;

class FormRequest extends \WPSPCORE\Validation\FormRequest {

	public function afterConstruct() {
		$this->data       = $this->extraParams['data'] ?: $this->collectData();
		$this->validation = Validation::instance();

		// Prepare data before validation.
		$this->prepareForValidation();
	}

	/*
	 *
	 */

	public function rules(): array {
		return [];
	}

	protected function getAuthorizationExceptionClass(): string {
		return AuthorizationException::class;
	}

}