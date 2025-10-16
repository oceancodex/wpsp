<?php

use WPSP\Funcs;

return [

	/*
	|--------------------------------------------------------------------------
	| Editor
	|--------------------------------------------------------------------------
	| Trình soạn thảo mở khi bấm "edit" trên trang lỗi của Ignition.
	| Hỗ trợ: "phpstorm", "vscode", "vscode-insiders", "sublime", "atom", "nova"
	*/
	'editor' => Funcs::env('APP_DEBUG_EDITOR', true, 'phpstorm'),

	/*
	|--------------------------------------------------------------------------
	| Theme
	|--------------------------------------------------------------------------
	| Giao diện trang lỗi: "dark", "light" hoặc "auto".
	*/
	'theme' => Funcs::env('APP_DEBUG_THEME', true, 'auto'),

	/*
	|--------------------------------------------------------------------------
	| Enable runnable solutions
	|--------------------------------------------------------------------------
	| Bật/tắt các “solution” có thể chạy trực tiếp từ Ignition.
	*/
	'enable_runnable_solutions' => Funcs::env('IGNITION_ENABLE_RUNNABLE_SOLUTIONS', true, true),

	/*
	|--------------------------------------------------------------------------
	| Remote <-> Local path mapping
	|--------------------------------------------------------------------------
	| Map đường dẫn từ môi trường remote sang local (Docker/WSL…) để link mở file chính xác.
	*/
	'remote_sites_path' => Funcs::env('IGNITION_REMOTE_SITES_PATH', true, ''),
	'local_sites_path'  => Funcs::env('IGNITION_LOCAL_SITES_PATH', true, ''),

	/*
	|--------------------------------------------------------------------------
	| Hide solutions
	|--------------------------------------------------------------------------
	| Ẩn panel “solutions” mặc định trong UI.
	*/
	'hide_solutions' => Funcs::env('IGNITION_HIDE_SOLUTIONS', true, false),

	/*
	|--------------------------------------------------------------------------
	| Max number of collected logs
	|--------------------------------------------------------------------------
	| Số lượng log tối đa hiển thị trên màn hình lỗi.
	*/
	'max_number_of_collected_logs' => Funcs::env('IGNITION_MAX_NUMBER_OF_COLLECTED_LOGS', true, 200),

	/*
	|--------------------------------------------------------------------------
	| Show code excerpt
	|--------------------------------------------------------------------------
	| Hiển thị trích đoạn code xung quanh dòng lỗi.
	*/
	'show_excerpt' => Funcs::env('IGNITION_SHOW_EXCERPT', true, true),

	/*
	|--------------------------------------------------------------------------
	| Ignored error levels
	|--------------------------------------------------------------------------
	| Bỏ qua một số cấp độ lỗi (không hiển thị trong UI của Ignition).
	*/
	'ignored_error_levels' => [
		E_DEPRECATED,
		E_USER_DEPRECATED,
		E_DEPRECATED
	],

	/*
	|--------------------------------------------------------------------------
	| Enable share reports (nếu bản Ignition hỗ trợ)
	|--------------------------------------------------------------------------
	| Cho phép chia sẻ báo cáo lỗi (ẩn thông tin nhạy cảm nếu cần).
	*/
	'enable_share_button' => Funcs::env('IGNITION_ENABLE_SHARE_BUTTON', true, false),

	/*
	|--------------------------------------------------------------------------
	| Solutions repositories (tùy chọn)
	|--------------------------------------------------------------------------
	| Thêm/bớt các kho “solutions” tùy chỉnh.
	*/
	'solutions' => [
		// \Spatie\Ignition\Solutions\SolutionProviderRepository::class => [],
	],

];