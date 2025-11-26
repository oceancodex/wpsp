<?php

namespace WPSP;

use WPSP\App\Instances\RateLimiter\RateLimiter;
use WPSP\App\Instances\Routes\RouteMap;
use WPSP\App\Instances\Auth\Auth;
use Faker\Factory as Faker;

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

	public static function getDBCustomMigrationTablePrefix(): string {
		return static::instance()->_getDBCustomMigrationTablePrefix();
	}

	public static function getDBTableName($name): string {
		return static::instance()->_getDBTableName($name);
	}

	public static function getDBCustomMigrationTableName($name): string {
		return static::instance()->_getDBCustomMigrationTableName($name);
	}

	public static function getBearerToken($request = null): ?string {
		return static::instance()->_getBearerToken($request);
	}

	/*
	 *
	 */

	public static function app($abstract = null, $args = []) {
		return static::instance()->_app($abstract, $args);
	}

	/**
	 * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard|Auth|null
	 */
	public static function auth($guard = null) {
		return Auth::instance($guard);
	}

	public static function view($viewName, $data = [], $mergeData = []) {
		return static::instance()->_view($viewName, $data, $mergeData);
	}

	public static function viewInject($views, $callback) {
		return static::instance()->_viewInject($views, $callback);
	}

	public static function trans($string, $wordpress = false) {
		return static::instance()->_trans($string, $wordpress);
	}

	public static function asset($path, $secure = null): string {
		return static::instance()->_asset($path, $secure);
	}

	public static function route(string $routeClass, string $routeName, $args = [], bool $buildURL = false): string {
		return static::instance()->_route(RouteMap::instance()->getMap(), $routeClass, $routeName, $args, $buildURL);
	}

	public static function config($key = null, $default = null) {
		return static::instance()->_config($key, $default);
	}

	public static function notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true): void {
		static::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}

	/*
	 *
	 */

	public static function rateLimiter(): \Illuminate\Cache\RateLimiter {
		return RateLimiter::instance()->getRateLimiter();
	}

	/*
	 *
	 */

	public static function isDev(): bool {
		return static::instance()->_isDev();
	}

	public static function isLocal(): bool {
		return static::instance()->_isLocal();
	}

	public static function isProduction(): bool {
		return static::instance()->_isProduction();
	}

	public static function isDebug(): bool {
		return static::instance()->_isDebug();
	}

	public static function isWPDebug(): bool {
		return static::instance()->_isWPDebug();
	}

	public static function isWPDebugLog(): bool {
		return static::instance()->_isWPDebugLog();
	}

	public static function isWPDebugDisplay(): bool {
		return static::instance()->_isWPDebugDisplay();
	}

	/*
	 *
	 */

	public static function buildUrl($baseUrl, $args) {
		return static::instance()->_buildUrl($baseUrl, $args);
	}

	public static function nonceName($name = null): string {
		return static::instance()->_nonceName($name);
	}

	public static function wantsJson(): bool {
		return static::instance()->_wantsJson();
	}

	public static function expectsJson(): bool {
		return static::instance()->_expectsJson();
	}

	public static function folderExists($path = null): bool {
		return static::instance()->_folderExists($path);
	}

	public static function vendorFolderExists($package = null): bool {
		return static::instance()->_vendorFolderExists($package);
	}

	public static function isLastMiddleware($currentClass, $allMiddlewares) {
		if (!is_array($allMiddlewares)) {
			return false;
		}

		// Lọc chỉ lấy key dạng số (0,1,2...)
		$middlewares = array();
		foreach ($allMiddlewares as $key => $value) {
			if (is_int($key)) {
				$middlewares[$key] = $value;
			}
		}

		if (empty($middlewares)) {
			return false;
		}

		// Lấy phần tử cuối cùng
		$last = end($middlewares);

		// dạng: [ 'ClassName', 'handle' ]
		if (is_array($last) && isset($last[0]) && $last[0] === $currentClass) {
			return true;
		}

		return false;
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
		return static::instance()->getApplication('queue');
	}

	public static function event($event = null, $payload = []) {
		$d = static::instance()->getApplication('event')->dispatcher();
		if ($event !== null) {
			$d->dispatch($event, $payload);
		}
		return $d;
	}

	public static function locale() {
		return static::instance()->_locale();
	}

	public static function response($success = false, $data = [], $message = ''): array {
		return static::instance()->_response($success, $data, $message);
	}

	public static function validate(array $data, array $rules, array $messages = [], array $customAttributes = []) {
		return static::validation()->validate($data, $rules, $messages, $customAttributes);
	}

	public static function validation() {
		return static::instance()->getApplication('validation');
	}

}