<?php

namespace WPSP\app\Http\Requests;

use WPSP\app\Extras\Instances\Requests\FormRequest;
use WPSP\app\Traits\InstancesTrait;

class SettingsUpdateRequest extends FormRequest {

	use InstancesTrait;

	public function authorize(): bool {
		// Kiểm tra quyền truy cập
		// Ví dụ: chỉ admin mới được phép
		return current_user_can('manage_options');
	}

	public function rules(): array {
		return [
			'test'             => ['required', 'string', 'max:10'],
			'site_description' => ['nullable', 'string', 'max:500'],
			'email'            => ['required', 'email'],
			'timezone'         => ['required', 'string'],
			'maintenance_mode' => ['required', 'boolean'],
		];
	}

//	public function messages(): array {
//		return [
//			'site_name.required'        => 'Tên website là bắt buộc.',
//			'site_name.max'             => 'Tên website không được vượt quá :max ký tự.',
//			'site_description.max'      => 'Mô tả website không được vượt quá :max ký tự.',
//			'email.required'            => 'Email quản trị không được để trống.',
//			'email.email'               => 'Định dạng email không hợp lệ.',
//			'timezone.required'         => 'Vui lòng chọn múi giờ.',
//			'maintenance_mode.required' => 'Trạng thái bảo trì là bắt buộc.',
//			'maintenance_mode.boolean'  => 'Trạng thái bảo trì không hợp lệ.',
//		];
//	}

//	public function attributes(): array {
//		return [
//			'site_name'        => 'tên website',
//			'site_description' => 'mô tả website',
//			'email'            => 'email quản trị',
//			'timezone'         => 'múi giờ',
//			'maintenance_mode' => 'chế độ bảo trì',
//		];
//	}

//	public function validated($key = null, $default = null): array {
//		$data = parent::validated();
//
//		// Có thể xử lý thêm dữ liệu sau khi validate
//		// Ví dụ: sanitize, transform data
//		if (isset($data['site_name'])) {
//			$data['site_name'] = sanitize_text_field($data['site_name']);
//		}
//
//		if (isset($data['site_description'])) {
//			$data['site_description'] = sanitize_textarea_field($data['site_description']);
//		}
//
//		if (isset($data['email'])) {
//			$data['email'] = sanitize_email($data['email']);
//		}
//
//		// Convert maintenance_mode to boolean
//		if (isset($data['maintenance_mode'])) {
//			$data['maintenance_mode'] = (bool)$data['maintenance_mode'];
//		}
//
//		return $data;
//	}

	/*
	 *
	 */

	protected function prepareForValidation(): void {
		// Có thể xử lý dữ liệu trước khi validate
		// Ví dụ: trim whitespace, convert types
		if ($this->has('maintenance_mode')) {
			$this->merge([
				'maintenance_mode' => filter_var(
					$this->input('maintenance_mode'),
					FILTER_VALIDATE_BOOLEAN,
					FILTER_NULL_ON_FAILURE
				),
			]);
		}
	}

}