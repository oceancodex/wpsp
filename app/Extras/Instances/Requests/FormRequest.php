<?php

namespace WPSP\app\Extras\Instances\Requests;

use WPSP\app\Exceptions\AuthorizationException;
use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\app\Traits\InstancesTrait;

class FormRequest extends \WPSPCORE\Validation\FormRequest {

	use InstancesTrait;

	public function afterConstruct() {
		$this->data       = $this->extraParams['data'] ?: $this->collectData();
//		$this->validation = Validation::instance();

		// Prepare data before validation.
		$this->prepareForValidation();
	}

	/*
	 *
	 */

	public function authorize(): bool {
		return false;
	}

	public function rules(): array {
		return [];
	}

	/*
	 *
	 */

	protected function getAuthorizationExceptionClass(): string {
		return AuthorizationException::class;
	}

}