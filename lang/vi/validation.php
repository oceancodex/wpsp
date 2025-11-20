<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Dòng thông báo xác thực
	|--------------------------------------------------------------------------
	|
	| Các dòng ngôn ngữ sau chứa các thông báo lỗi mặc định được sử dụng bởi
	| lớp validator. Một số quy tắc có nhiều phiên bản, chẳng hạn như quy tắc size.
	| Bạn có thể tùy chỉnh các thông báo này theo ý muốn.
	|
	*/

	'accepted' => ':attribute phải được chấp nhận.',
	'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
	'active_url' => ':attribute không phải là một URL hợp lệ.',
	'after' => ':attribute phải là một ngày sau :date.',
	'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
	'alpha' => ':attribute chỉ được chứa các ký tự chữ.',
	'alpha_dash' => ':attribute chỉ được chứa chữ, số, dấu gạch ngang và gạch dưới.',
	'alpha_num' => ':attribute chỉ được chứa chữ và số.',
	'array' => ':attribute phải là một mảng.',
	'before' => ':attribute phải là một ngày trước :date.',
	'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
	'between' => [
		'numeric' => ':attribute phải nằm trong khoảng :min đến :max.',
		'file' => ':attribute phải có dung lượng từ :min đến :max kilobytes.',
		'string' => ':attribute phải có độ dài từ :min đến :max ký tự.',
		'array' => ':attribute phải có từ :min đến :max phần tử.',
	],
	'boolean' => 'Trường :attribute phải là true hoặc false.',
	'confirmed' => 'Xác nhận :attribute không khớp.',
	'current_password' => 'Mật khẩu không chính xác.',
	'date' => ':attribute không phải là ngày hợp lệ.',
	'date_equals' => ':attribute phải là ngày bằng :date.',
	'date_format' => ':attribute không đúng định dạng :format.',
	'declined' => ':attribute phải bị từ chối.',
	'declined_if' => ':attribute phải bị từ chối khi :other là :value.',
	'different' => ':attribute và :other phải khác nhau.',
	'digits' => ':attribute phải có :digits chữ số.',
	'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
	'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
	'distinct' => 'Trường :attribute có giá trị trùng lặp.',
	'email' => ':attribute phải là địa chỉ email hợp lệ.',
	'ends_with' => ':attribute phải kết thúc bằng một trong những giá trị sau: :values.',
	'enum' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
	'exists' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
	'file' => ':attribute phải là một tệp.',
	'filled' => 'Trường :attribute phải có giá trị.',
	'gt' => [
		'numeric' => ':attribute phải lớn hơn :value.',
		'file' => ':attribute phải lớn hơn :value kilobytes.',
		'string' => ':attribute phải dài hơn :value ký tự.',
		'array' => ':attribute phải có nhiều hơn :value phần tử.',
	],
	'gte' => [
		'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
		'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
		'string' => ':attribute phải dài hơn hoặc bằng :value ký tự.',
		'array' => ':attribute phải có ít nhất :value phần tử.',
	],
	'image' => ':attribute phải là một hình ảnh.',
	'in' => 'Giá trị được chọn cho :attribute không hợp lệ.',
	'in_array' => 'Trường :attribute không tồn tại trong :other.',
	'integer' => ':attribute phải là số nguyên.',
	'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
	'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
	'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
	'json' => ':attribute phải là chuỗi JSON hợp lệ.',
	'lt' => [
		'numeric' => ':attribute phải nhỏ hơn :value.',
		'file' => ':attribute phải nhỏ hơn :value kilobytes.',
		'string' => ':attribute phải ngắn hơn :value ký tự.',
		'array' => ':attribute phải có ít hơn :value phần tử.',
	],
	'lte' => [
		'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
		'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
		'string' => ':attribute phải ngắn hơn hoặc bằng :value ký tự.',
		'array' => ':attribute không được có nhiều hơn :value phần tử.',
	],
	'mac_address' => ':attribute phải là địa chỉ MAC hợp lệ.',
	'max' => [
		'numeric' => ':attribute không được lớn hơn :max.',
		'file' => ':attribute không được lớn hơn :max kilobytes.',
		'string' => ':attribute không được dài hơn :max ký tự.',
		'array' => ':attribute không được có nhiều hơn :max phần tử.',
	],
	'mimes' => ':attribute phải là tệp có định dạng: :values.',
	'mimetypes' => ':attribute phải là tệp có định dạng: :values.',
	'min' => [
		'numeric' => ':attribute phải tối thiểu là :min.',
		'file' => ':attribute phải có ít nhất :min kilobytes.',
		'string' => ':attribute phải có ít nhất :min ký tự.',
		'array' => ':attribute phải có ít nhất :min phần tử.',
	],
	'multiple_of' => ':attribute phải là bội số của :value.',
	'not_in' => 'Giá trị được chọn cho :attribute không hợp lệ.',
	'not_regex' => 'Định dạng của :attribute không hợp lệ.',
	'numeric' => ':attribute phải là số.',
	'password' => 'Mật khẩu không chính xác.',
	'present' => 'Trường :attribute phải có mặt.',
	'prohibited' => 'Trường :attribute bị cấm.',
	'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
	'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
	'prohibits' => 'Trường :attribute ngăn không cho :other xuất hiện.',
	'regex' => 'Định dạng của :attribute không hợp lệ.',
	'required' => 'Trường :attribute là bắt buộc.',
	'required_array_keys' => 'Trường :attribute phải chứa các khóa: :values.',
	'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
	'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
	'required_with' => 'Trường :attribute là bắt buộc khi :values có mặt.',
	'required_with_all' => 'Trường :attribute là bắt buộc khi :values có mặt.',
	'required_without' => 'Trường :attribute là bắt buộc khi :values không có mặt.',
	'required_without_all' => 'Trường :attribute là bắt buộc khi không có bất kỳ :values nào có mặt.',
	'same' => ':attribute và :other phải giống nhau.',
	'size' => [
		'numeric' => ':attribute phải bằng :size.',
		'file' => ':attribute phải có dung lượng :size kilobytes.',
		'string' => ':attribute phải có :size ký tự.',
		'array' => ':attribute phải chứa :size phần tử.',
	],
	'starts_with' => ':attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
	'string' => ':attribute phải là chuỗi ký tự.',
	'timezone' => ':attribute phải là múi giờ hợp lệ.',
	'unique' => ':attribute đã được sử dụng.',
	'uploaded' => 'Tải lên :attribute thất bại.',
	'url' => ':attribute phải là URL hợp lệ.',
	'uuid' => ':attribute phải là UUID hợp lệ.',

	/*
	|--------------------------------------------------------------------------
	| Thông báo xác thực tùy chỉnh
	|--------------------------------------------------------------------------
	|
	| Bạn có thể chỉ định thông báo tùy chỉnh cho từng thuộc tính cụ thể
	| bằng cách sử dụng cú pháp "attribute.rule".
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'Thông báo tùy chỉnh',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Thuộc tính xác thực tùy chỉnh
	|--------------------------------------------------------------------------
	|
	| Các dòng ngôn ngữ sau được dùng để thay thế tên thuộc tính mặc định
	| bằng các tên thân thiện hơn như “Địa chỉ Email” thay vì “email”.
	|
	*/

	'attributes' => [],

];
