<?php

namespace WPSP\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use WPSP\App\Exceptions\InvalidDataException;

class UsersUpdateRequest extends FormRequest {

	// Đặt "input_user_id" để đảm bảo 2 việc:
	// 1. User hiện tại giữ nguyên "email, username" thì vẫn validate thành công.
	// 2. User hiện tại không thể đổi "email, username" thành email, username của một người khác.
	public $input_user_id = null;
	public $authUser      = null;

	/**
	 * Xác định xem người dùng hiện tại có được phép gửi request này không.
	 *
	 * Bạn có thể thêm logic kiểm tra phân quyền tại đây.
	 * Ví dụ: chỉ admin mới được phép cập nhật settings.
	 */
	public function authorize(): bool {
		return current_user_can('administrator') || $this->input_user_id == ($this->authUser->id ?? $this->authUser->ID);
	}

	/**
	 * Chỉnh sửa dữ liệu trước khi validate.
	 *
	 * Ví dụ: ép kiểu boolean, cắt khoảng trắng,...
	 */
	public function prepareForValidation() {
//		if ($this->has('name')) {
//			$this->merge([
//				'name' => filter_var(
//					$this->input('name'),
//					FILTER_VALIDATE_BOOLEAN,
//					FILTER_NULL_ON_FAILURE
//				),
//			]);
//		}
	}

	/**
	 * Các rules (luật) validate cho dữ liệu gửi lên.
	 *
	 * Mỗi key tương ứng với tên field trong request.
	 * Tự động kiểm tra dữ liệu và trả về lỗi 422 nếu không hợp lệ.
	 */
	public function rules(): array {
		return [
			'name' => [
				'required',
				'string',
				'max:255',
				Rule::unique('users', 'name')->ignore($this->input_user_id)
			],
			'email' => [
				'required',
				'email',
				'max:255',
				Rule::unique('users', 'email')->ignore($this->input_user_id)
			],
		];
	}

	/**
	 * Tùy chỉnh message lỗi trả về cho từng rule.
	 * Ứng dụng sẽ dùng các message này nếu rule tương ứng bị vi phạm.
	 */
	public function messages(): array {
		return [
			'email.required' => 'Email là bắt buộc.',
			'email.email'    => 'Email không hợp lệ.',
			'email.unique'   => 'Email đã được sử dụng.',
		];
	}

	/**
	 * (Tùy chọn) Tùy chỉnh tên hiển thị cho các field.
	 */
	public function attributes(): array {
		return [
			'email' => 'Email',
			'name'  => 'Name',
		];
	}

	/**
	 * Xử lý dữ liệu sau khi validated.
	 */
	public function passedValidation() {}

	/**
	 * Tùy biến logic sau khi chạy xong validate và trước khi validate thành công.
	 */
	public function after(): array {
		return [
//			function($validator) {
//				$value = $this->input('settings.setting_1');
//
//				if (!$value && current_user_can('administrator')) {
//					$validator->errors()->add('settings.logo', 'Bạn là admin, bạn cần điền "setting_1".');
//				}
//			},
		];
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