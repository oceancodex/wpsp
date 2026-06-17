<?php

namespace WPSP;

use Faker\Factory as Faker;
use NumberFormatter;
use WPSP\App\Widen\Routes\RouteMap;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\App\Widen\Support\Facades\RateLimiter;

class Funcs extends \WPSPCORE\Funcs {

	const PREFIX_ENV = 'WPSP_';

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	/**
	 * Instance.
	 *
	 * @return \WPSPCORE\Funcs|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static(
				__DIR__,
				__NAMESPACE__,
				static::PREFIX_ENV
			);
		}
		return static::$instance;
	}

	/**
	 * Static functions.
	 */

	public static function getDBTablePrefix() {
		return static::instance()->_getDBTablePrefix();
	}

	public static function getDBCustomMigrationTablePrefix() {
		return static::instance()->_getDBCustomMigrationTablePrefix();
	}

	public static function getDBTableName($name) {
		return static::instance()->_getDBTableName($name);
	}

	public static function getDBCustomMigrationTableName($name) {
		return static::instance()->_getDBCustomMigrationTableName($name);
	}

	public static function getBearerToken($request = null) {
		return static::instance()->_getBearerToken($request);
	}

	/*
	 *
	 */

	public static function app($abstract = null, $parameters = []) {
		return static::instance()->_app($abstract, $parameters);
	}

	/**
	 * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard|Auth|\WPSPCORE\App\Auth\Auth|null
	 */
	public static function auth($guard = null) {
		return Auth::instance($guard);
	}

	public static function view($viewName, $data = [], $mergeData = []) {
		return static::instance()->_view($viewName, $data, $mergeData);
	}

	public static function viewInject($views, $data = []) {
		return static::instance()->_viewInject($views, $data);
	}

	public static function viewDetect($viewName) {
		return static::instance()->_viewDetect($viewName);
	}

	public static function trans($string, $replaces = [], $wordpress = false) {
		return static::instance()->_trans($string, $replaces, $wordpress);
	}

	public static function asset($path, $secure = null) {
		return static::instance()->_asset($path, $secure);
	}

	public static function route($routeClass, $routeName, $args = [], $buildURL = false, $sanitize = true) {
		return static::instance()->_route($routeClass, $routeName, $args, $buildURL, $sanitize, RouteMap::instance()->getMap());
	}

	public static function config($key = null, $default = null) {
		return static::instance()->_config($key, $default);
	}

	public static function notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true) {
		static::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}

	/**
	 * Tự động hiển thị admin notice khi thực hiện các actions.
	 */
	public static function actionNotice(?\Illuminate\Http\Request $request = null) {
		if ($request?->query('saved') || isset($_GET['saved'])) {
			Funcs::notice(Funcs::trans('messages.notice_saved'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($request?->query('updated') || isset($_GET['updated'])) {
			Funcs::notice(Funcs::trans('messages.notice_updated'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($request?->query('trashed') ?? isset($_GET['trashed'])) {
			Funcs::notice(Funcs::trans('messages.notice_trashed'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($request?->query('untrashed') ?? isset($_GET['untrashed'])) {
			Funcs::notice(Funcs::trans('messages.notice_untrashed'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($request?->query('deleted') ?? isset($_GET['deleted'])) {
			Funcs::notice(Funcs::trans('messages.notice_deleted'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($request?->query('locked') ?? isset($_GET['locked'])) {
			Funcs::notice(Funcs::trans('messages.notice_locked'), $_GET['notice_type'] ?? 'success');
		}
		elseif ($error = ($request?->query('error') ?? $_GET['error'] ?? null)) {
			Funcs::notice(Funcs::trans('messages.notice_error', ['error' => $_GET['error']]), $_GET['notice_type'] ?? 'error');
		}
		elseif ($message = ($request?->query('message') ?? $_GET['message'] ?? null)) {
			Funcs::notice(Funcs::trans('messages.notice_message', ['message' => $_GET['message']]), $_GET['notice_type'] ?? 'info');
		}
	}

	/*
	 *
	 */

	public static function rateLimiter() {
		return RateLimiter::instance()->getRateLimiter();
	}

	/*
	 * Boolean methods
	 */

	public static function isDev() {
		return static::instance()->_isDev();
	}

	public static function isLocal() {
		return static::instance()->_isLocal();
	}

	public static function isProduction() {
		return static::instance()->_isProduction();
	}

	public static function isDebug() {
		return static::instance()->_isDebug();
	}

	public static function isWPDebug() {
		return static::instance()->_isWPDebug();
	}

	public static function isWPDebugLog() {
		return static::instance()->_isWPDebugLog();
	}

	public static function isWPDebugDisplay() {
		return static::instance()->_isWPDebugDisplay();
	}

	public static function hasQueryParams($queryString = null, $targetParams = null, $relation = 'or') {
		return static::instance()->_hasQueryParams($queryString, $targetParams, $relation);
	}

	public static function onlyHasQueryParams($queryString = null, $allowedParams = null) {
		return static::instance()->_onlyHasQueryParams($queryString, $allowedParams);
	}

	/*
	 *
	 */

	public static function buildUrl($baseUrl, $args) {
		return static::instance()->_buildUrl($baseUrl, $args);
	}

	public static function nonceName($name = null) {
		return static::instance()->_nonceName($name);
	}

	public static function wantsJson() {
		return static::instance()->_wantsJson();
	}

	public static function expectsJson() {
		return static::instance()->_expectsJson();
	}

	public static function folderExists($path = null) {
		return static::instance()->_folderExists($path);
	}

	public static function vendorFolderExists($package = null) {
		return static::instance()->_vendorFolderExists($package);
	}

	public static function numberFormat($value, $precision = 0, $endWithZeros = true, $locale = 'vi', $currencyCode = 'vnd', $style = NumberFormatter::DECIMAL, $groupingUsed = true) {
		return static::instance()->_numberFormat($value, $precision, $endWithZeros, $locale, $currencyCode, $style, $groupingUsed);
	}

	public static function unNumberFormat($value, $locale = 'vi') {
		return static::instance()->_unNumberFormat($value, $locale);
	}

	/*
	 *
	 */

	public static function env($var, $addPrefix = false, $default = null) {
		return static::instance()->_env($var, $addPrefix, $default);
	}

	public static function debug($message = '', $print = false, $varDump = false) {
		static::instance()->_debug($message, $print, $varDump);
	}

	public static function faker() {
		try {
			return Faker::create(Funcs::config('app.faker_locale', 'en_US'));
		}
		catch (\Throwable $e) {
			return null;
		}
	}

	public static function queue() {
		return static::instance()->_getApplication('queue');
	}

	public static function event($event = null, $payload = []) {
		$d = static::instance()->_getApplication('event')->dispatcher();
		if ($event !== null) {
			$d->dispatch($event, $payload);
		}
		return $d;
	}

	public static function locale() {
		return static::instance()->_locale();
	}

	public static function response($success = false, $data = [], $message = '') {
		return static::instance()->_response($success, $data, $message);
	}

	public static function validate($data, $rules, $messages = [], $customAttributes = []) {
		return static::validation()->validate($data, $rules, $messages, $customAttributes);
	}

	public static function validation() {
		return static::instance()->_getApplication('validation');
	}

}