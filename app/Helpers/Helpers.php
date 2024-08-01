<?php
use WPSP\Funcs;
if (!function_exists('wpsp_trans')) {
	function wpsp_trans($string, $wordpress = false) {
		return Funcs::instance()->_trans($string, $wordpress);
	}
}
if (!function_exists('wpsp_view')) {
	function wpsp_view($viewName, $data = [], $mergeData = []): \Illuminate\Contracts\View\View {
		return Funcs::instance()->_view($viewName, $data, $mergeData);
	}
}
if (!function_exists('wpsp_config')) {
	function wpsp_config($key = null, $default = null) {
		return Funcs::instance()->_config($key, $default);
	}
}
if (!function_exists('wpsp_notice')) {
	function wpsp_notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true): void {
		Funcs::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}
}
if (!function_exists('wpsp_asset')) {
	function wpsp_asset($path, $secure = null): ?string {
		return Funcs::instance()->_asset($path, $secure);
	}
}
if (!function_exists('wpsp_env')) {
	function wpsp_env($var, $addPrefix = false, $default = null): ?string {
		return Funcs::instance()->_env($var, $addPrefix, $default);
	}
}
if (!function_exists('wpsp_debug')) {
	function wpsp_debug($message = '', $print = false, bool $varDump = false): void {
		Funcs::instance()->_debug($message, $print, $varDump);
	}
}
if (!function_exists('wpsp_response')) {
	function wpsp_response($message = '', $print = false, bool $varDump = false): array {
		return Funcs::instance()->_response($message, $print, $varDump);
	}
}
if (!function_exists('wpsp_locale')) {
	function wpsp_locale(): string {
		return Funcs::instance()->_locale();
	}
}
if (!function_exists('wpsp_main_path')) {
	function wpsp_main_path($path = null): string {
		return Funcs::instance()->_getMainPath($path);
	}
}
if (!function_exists('wpsp_resources_path')) {
	function wpsp_resources_path($path = null): string {
		return Funcs::instance()->_getResourcesPath($path);
	}
}