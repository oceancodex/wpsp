<?php

namespace WPSP\app\Http\Requests;

use Illuminate\Validation\Rule;
use WPSP\app\Extras\Instances\Requests\FormRequest;
use WPSP\app\Traits\InstancesTrait;

class UsersUpdateRequest extends FormRequest {

	use InstancesTrait;

	// Đặt "input_user_id" để đảm bảo 2 việc:
	// 1. User hiện tại giữ nguyên "email" thì vẫn validate thành công.
	// 2. User hiện tại không thể đổi "email" thành email của một người khác.
	public $input_user_id = null;
	public $authUser      = null;

	/**
	 * Xác định xem người dùng hiện tại có được phép gửi request này không.
	 *
	 * Bạn có thể thêm logic kiểm tra phân quyền tại đây.
	 * Ví dụ: chỉ admin mới được phép cập nhật settings.
	 */
	public function authorize() {
		return $this->input_user_id == ($this->authUser->id ?? $this->authUser->ID);
	}

	/**
	 * Các rules (luật) validate cho dữ liệu gửi lên.
	 *
	 * Mỗi key tương ứng với tên field trong request.
	 * Tự động kiểm tra dữ liệu và trả về lỗi 422 nếu không hợp lệ.
	 */
	public function rules(): array {
		return [
			'email' => [
				'required',
				'email',
				'max:255',
				Rule::unique('cm_users', 'email')->ignore($this->input_user_id)
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
			'email.unique'   => 'Email đã tồn tại.',
		];
	}

	/**
	 * Xử lý dữ liệu sau khi validated.
	 */
	public function validated($key = null, $default = null): array {
		$data = parent::validated();

		if (isset($data['email'])) {
			$data['email'] = strtolower($data['email']);
		}

		return $data;
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
	 * (Tùy chọn) Tùy chỉnh tên hiển thị cho các field.
	 *
	 * Giúp thông báo lỗi thân thiện hơn, ví dụ:
	 * "Trường 'Tên website' không được để trống."
	 */
	public function attributes(): array {
		return [
			'email' => 'Email',
		];
	}

}