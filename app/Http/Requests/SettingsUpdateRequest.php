<?php

namespace WPSP\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest {

	/**
	 * Xác định xem người dùng hiện tại có được phép gửi request này không.
	 *
	 * Bạn có thể thêm logic kiểm tra phân quyền tại đây.
	 * Ví dụ: chỉ admin mới được phép cập nhật settings.
	 */
	public function authorize(): bool {
		return current_user_can('manage_options');
	}

	/**
	 * Chỉnh sửa dữ liệu trước khi validate.
	 *
	 * Ví dụ: ép kiểu boolean, cắt khoảng trắng,...
	 */
	public function prepareForValidation() {
		if ($this->has('test')) {
//			$this->merge([
//				'test' => filter_var(
//					$this->input('test'),
//					FILTER_VALIDATE_BOOLEAN,
//					FILTER_NULL_ON_FAILURE
//				),
//			]);
		}
	}

	/**
	 * Các rules (luật) validate cho dữ liệu gửi lên.
	 *
	 * Mỗi key tương ứng với tên field trong request.
	 * Tự động kiểm tra dữ liệu và trả về lỗi 422 nếu không hợp lệ.
	 */
	public function rules(): array {
		return [
			'test'          => ['required', 'string', 'min:10'],
			'settings.logo' => ['required', 'string', 'min:10', 'max:50'],
		];
	}

	/**
	 * Tùy chỉnh message lỗi trả về cho từng rule.
	 * Ứng dụng sẽ dùng các message này nếu rule tương ứng bị vi phạm.
	 */
	public function messages(): array {
		return [
			'settings.logo.required' => 'Logo website là bắt buộc.',
		];
	}

	/**
	 * (Tùy chọn) Tùy chỉnh tên hiển thị cho các field.
	 */
	public function attributes(): array {
		return [
			'settings.logo' => 'Logo website (settings[logo])',
			'test' => 'TEST',
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
			function($validator) {
				$value = $this->input('settings.setting_1');

				if (!$value && current_user_can('administrator')) {
					$validator->errors()->add('settings.logo', 'Bạn là admin, bạn cần điền "setting_1".');
				}
			},
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

		parent::failedValidation($validator);
	}

}