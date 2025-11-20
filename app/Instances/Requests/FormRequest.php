<?php

namespace WPSP\App\Instances\Requests;

use WPSP\App\Exceptions\AuthorizationException;
use WPSP\App\Traits\InstancesTrait;

if (class_exists('WPSPCORE\Validation\FormRequest')) {
	class FormRequest extends \WPSPCORE\Validation\FormRequest {

		use InstancesTrait;

		public function afterConstruct() {
			$this->data = $this->extraParams['data'] ?? $this->collectData();

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
}
else {
	class FormRequest {
		public function __call($name, $arguments) {
			// Nếu method có kiểu trả về "array", trả về []
			if (in_array($name, ['validated', 'rules', 'all', 'messages', 'attributes'])) {
				return [];
			}

			// Nếu method có kiểu trả về "bool"
			if (in_array($name, ['authorize'])) {
				return false;
			}

			// Mặc định trả về null
			return null;
		}
	}
}