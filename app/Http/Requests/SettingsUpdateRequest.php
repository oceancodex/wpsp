<?php

namespace WPSP\app\Http\Requests;

use WPSP\app\Extras\Instances\Requests\FormRequest;
use WPSP\app\Traits\InstancesTrait;

class SettingsUpdateRequest extends FormRequest {

	use InstancesTrait;

	/**
	 * Xác định xem người dùng hiện tại có được phép gửi request này không.
	 *
	 * Bạn có thể thêm logic kiểm tra phân quyền tại đây.
	 * Ví dụ: chỉ admin mới được phép cập nhật settings.
	 */
	public function authorize() {
		return false;
		return current_user_can('manage_options');
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
			'settings.logo' => ['required', 'string', 'max:10'],
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
	 * Xử lý dữ liệu sau khi validated.
	 */
	public function validated($key = null, $default = null): array {
		$data = parent::validated();

		if (isset($data['settings']['logo'])) {
			$data['settings']['logo'] = strtoupper($data['settings']['logo']);
		}

		return $data;
	}

	/**
	 * Chỉnh sửa dữ liệu trước khi validate.
	 *
	 * Ví dụ: ép kiểu boolean, cắt khoảng trắng,...
	 */
	public function prepareForValidation() {
		if ($this->has('test')) {
			$this->merge([
				'test' => filter_var(
					$this->input('test'),
					FILTER_VALIDATE_BOOLEAN,
					FILTER_NULL_ON_FAILURE
				),
			]);
		}
	}

	/**
	 * (Tùy chọn) Tùy chỉnh tên hiển thị cho các field.
	 *
	 * Giúp thông báo lỗi thân thiện hơn, ví dụ:
	 * "Trường 'Tên website' không được để trống."
	 */
	public function attributes(): array {
		return [
			'settings.logo' => 'settings[logo]',
		];
	}

}