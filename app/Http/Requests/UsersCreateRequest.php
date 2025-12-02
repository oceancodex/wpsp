<?php

namespace WPSP\App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use WPSP\App\Exceptions\InvalidDataException;

class UsersCreateRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return [
			'name'  => 'required|string|max:255',
			'email' => 'required|string|email|unique:users,email',
			'password' => ['required','string','min:8','confirmed'],
		];
	}

	/**
	 * Handle a failed authorization attempt.
	 */
	protected function failedAuthorization() {
		// Nếu là Rest API thì cần phải chuyển header content type sang HTML.
		header('Content-Type: text/html; charset=utf-8');
		throw new AuthorizationException('This action is unauthorized.');
	}

	/**
	 * Tùy chỉnh cách phản hồi khi validate không thành công.
	 */
	public function failedValidation($validator) {
		if ($this->expectsJson()) {
			wp_send_json([
				'success' => false,
				'errors'  => $validator->errors()->messages(),
				'message' => 'Dữ liệu không hợp lệ',
			], 422);
			exit;
		}

		header('Content-Type: text/html; charset=utf-8');

		$errors = $validator->errors()->all();
		$errorList = '<ul>';
		foreach ($errors as $error) {
			$errorList .= '<li>' . esc_html($error) . '</li>';
		}
		$errorList .= '</ul>';

		throw new InvalidDataException($errorList);

//		parent::failedValidation($validator);
	}

}
