<?php

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\app\Extras\Instances\Events\Event;
use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;

if (!function_exists('wpsp_env')) {
	function wpsp_env($var, $addPrefix = false, $default = null) {
		return Funcs::instance()->_env($var, $addPrefix, $default);
	}
}
if (!function_exists('wpsp_auth')) {
	function wpsp_auth($guard = null) {
		if (class_exists('\WPSPCORE\Auth\Auth')) {
			return Auth::instance()->guard($guard);
		}
		else {
			return null;
		}
	}
}
if (!function_exists('wpsp_view')) {
	function wpsp_view($viewName = null, $data = [], $mergeData = []) {
		return Funcs::instance()->_view($viewName, $data, $mergeData);
	}
}
if (!function_exists('wpsp_view_inject')) {
	function wpsp_view_inject($views, $callback) {
		return Funcs::instance()->_viewInject($views, $callback);
	}
}
if (!function_exists('wpsp_asset')) {
	function wpsp_asset($path, $secure = null) {
		return Funcs::instance()->_asset($path, $secure);
	}
}
if (!function_exists('wpsp_debug')) {
	function wpsp_debug($message = '', $print = false, $varDump = false) {
		Funcs::instance()->_debug($message, $print, $varDump);
	}
}
if (!function_exists('wpsp_trans')) {
	function wpsp_trans($string, $wordpress = false) {
		return Funcs::instance()->_trans($string, $wordpress);
	}
}
if (!function_exists('wpsp_config')) {
	function wpsp_config($key = null, $default = null) {
		return Funcs::instance()->_config($key, $default);
	}
}
if (!function_exists('wpsp_notice')) {
	function wpsp_notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true) {
		Funcs::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}
}
if (!function_exists('wpsp_locale')) {
	function wpsp_locale() {
		return Funcs::instance()->_locale();
	}
}
if (!function_exists('wpsp_response')) {
	function wpsp_response($message = '', $print = false, $varDump = false) {
		return Funcs::instance()->_response($message, $print, $varDump);
	}
}
if (!function_exists('wpsp_main_path')) {
	function wpsp_main_path($path = null) {
		return Funcs::instance()->_getMainPath($path);
	}
}
if (!function_exists('wpsp_nonce_field')) {
	function wpsp_nonce_field($action = -1, $name = '_wpnonce', $referer = true, $display = true) {
		return wp_nonce_field($action, $name, $referer, $display);
	}
}
if (!function_exists('wpsp_resources_path')) {
	function wpsp_resources_path($path = null) {
		return Funcs::instance()->_getResourcesPath($path);
	}
}
if (!function_exists('wpsp_bearer_token')) {
	function wpsp_bearer_token() {
		return Funcs::instance()->_getBearerToken();
	}
}
if (!function_exists('wpsp_event')) {
	function wpsp_event($event = null, $payload = []) {
		$d = Event::dispatcher();
		if ($event !== null) {
			$d->dispatch($event, $payload);
		}
		return $d;
	}
}
if (!function_exists('wpsp_validation')) {
	function wpsp_validation() {
		return Validation::instance();
	}
}
if (!function_exists('wpsp_validate')) {
	function wpsp_validate(array $data, array $rules, array $messages = [], array $customAttributes = []) {
		return Validation::validate($data, $rules, $messages, $customAttributes);
	}
}

if (!function_exists('wpsp_abort')) {
	function wpsp_abort(int $code, string $message = '', array $headers = []) {
		throw new \WPSP\app\Exceptions\HttpException($code, $message, $headers);
	}
}
if (!function_exists('wpsp_abort_500')) {
	function wpsp_abort_500(string $message = 'Internal Server Error') {
		wpsp_abort(500, $message);
	}
}
if (!function_exists('wpsp_abort_404')) {
	function wpsp_abort_404(string $message = 'Page not found') {
		wpsp_abort(404, $message);
	}
}
if (!function_exists('wpsp_abort_403')) {
	function wpsp_abort_403(string $message = 'Forbidden') {
		wpsp_abort(403, $message);
	}
}
if (!function_exists('wpsp_abort_503')) {
	function wpsp_abort_503(string $message = 'Service Unavailable') {
		wpsp_abort(503, $message);
	}
}
if (!function_exists('wpsp_abort_401')) {
	function wpsp_abort_401(string $message = 'Unauthorized') {
		wpsp_abort(401, $message);
	}
}
if (!function_exists('wpsp_abort_400')) {
	function wpsp_abort_400(string $message = 'Bad Request') {
		wpsp_abort(400, $message);
	}
}
if (!function_exists('wpsp_abort_422')) {
	function wpsp_abort_422(string $message = 'Unprocessable Entity') {
		wpsp_abort(422, $message);
	}
}
if (!function_exists('wpsp_abort_405')) {
	function wpsp_abort_405(string $message = 'Method Not Allowed') {
		wpsp_abort(405, $message);
	}
}