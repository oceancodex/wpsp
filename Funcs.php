<?php

namespace WPSP;

use WPSP\App\Instances\Routes\RouteMap;
use WPSP\App\Workers\Auth\Auth;
use WPSP\App\Workers\Events\Events;
use WPSP\App\Workers\Queue\Queue;
use WPSP\App\Workers\Validation\Validation;

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
				static::PREFIX_ENV,
				[]
			);
		}
		return static::$instance;
	}

	/**
	 * Static functions.
	 */

	public static function getDBTablePrefix() {
		return self::instance()->_getDBTablePrefix();
	}

	public static function getDBCustomMigrationTablePrefix() {
		return self::instance()->_getDBCustomMigrationTablePrefix();
	}

	public static function getDBTableName($name) {
		return self::instance()->_getDBTableName($name);
	}

	public static function getDBCustomMigrationTableName($name) {
		return self::instance()->_getDBCustomMigrationTableName($name);
	}

	/*
	 *
	 */

	public static function app($abstract = null, $args = []) {
		return self::instance()->_app($abstract, $args);
	}

	public static function auth($guard = null) {
		return Auth::instance()->guard($guard);
	}

	public static function view($viewName, $data = [], $mergeData = []) {
		return self::instance()->_view($viewName, $data, $mergeData);
	}

	public static function trans($string, $wordpress = false) {
		return self::instance()->_trans($string, $wordpress);
	}

	public static function asset($path, $secure = null) {
		return self::instance()->_asset($path, $secure);
	}

	public static function route(string $routeClass, string $routeName, $args = [], bool $buildURL = false) {
		return self::instance()->_route(RouteMap::instance()->mapIdea, $routeClass, $routeName, $args, $buildURL);
	}

	public static function config($key = null, $default = null) {
		return self::instance()->_config($key, $default);
	}

	public static function notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true) {
		self::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}

	public static function viewInject($views, $callback) {
		return self::instance()->_viewInject($views, $callback);
	}

	/*
	 *
	 */

	public static function isDev() {
		return self::instance()->_isDev();
	}

	public static function isLocal() {
		return self::instance()->_isLocal();
	}

	public static function isProduction() {
		return self::instance()->_isProduction();
	}

	public static function isDebug() {
		return self::instance()->_isDebug();
	}

	public static function isWPDebug() {
		return self::instance()->_isWPDebug();
	}

	public static function isWPDebugLog() {
		return self::instance()->_isWPDebugLog();
	}

	public static function isWPDebugDisplay() {
		return self::instance()->_isWPDebugDisplay();
	}

	/*
	 *
	 */

	public static function buildUrl($baseUrl, $args) {
		return self::instance()->_buildUrl($baseUrl, $args);
	}

	public static function nonceName($name = null) {
		return self::instance()->_nonceName($name);
	}

	public static function wantsJson() {
		return self::instance()->_wantsJson();
	}

	public static function expectsJson() {
		return self::instance()->_expectsJson();
	}

	public static function folderExists($path = null) {
		return self::instance()->_folderExists($path);
	}

	public static function vendorFolderExists($package = null) {
		return self::instance()->_vendorFolderExists($package);
	}

	/*
	 *
	 */

	public static function env($var, $addPrefix = false, $default = null) {
		return self::instance()->_env($var, $addPrefix, $default);
	}

	public static function debug($message = '', $print = false, $varDump = false) {
		self::instance()->_debug($message, $print, $varDump);
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
		return Queue::instance();
	}

	public static function event($event = null, $payload = []) {
		$d = Events::instance()->dispatcher();
		if ($event !== null) {
			$d->dispatch($event, $payload);
		}
		return $d;
	}

	public static function locale() {
		return self::instance()->_locale();
	}

	public static function response($success = false, $data = [], $message = '') {
		return self::instance()->_response($success, $data, $message);
	}

	public static function validate(array $data, array $rules, array $messages = [], array $customAttributes = []) {
		return self::validation()->validate($data, $rules, $messages, $customAttributes);
	}

	public static function validation() {
		return Validation::instance();
	}

}