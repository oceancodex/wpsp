<?php

namespace WPSP\app\Workers\Requests;

use WPSP\app\Exceptions\AuthorizationException;
use WPSP\app\Workers\Validation\Validation;
use WPSP\app\Traits\InstancesTrait;

class FormRequest extends \WPSPCORE\Validation\FormRequest {

	use InstancesTrait;

	public function afterConstruct() {
		$this->data = $this->extraParams['data'] ?: $this->collectData();

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