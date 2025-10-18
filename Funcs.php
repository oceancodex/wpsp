<?php
namespace WPSP;

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\app\Extras\Instances\Validation\Validation;

class Funcs extends \WPSPCORE\Funcs {

	const PREFIX_ENV = 'WPSP_';

	private static $instance = null;

	/**
	 * Instance.
	 *
	 * @return \WPSPCORE\Funcs|null
	 */
	public static function instance() {
		if (!self::$instance) {
			self::$instance = new self(
				__DIR__,
				__NAMESPACE__,
				self::PREFIX_ENV,
				[
					'prepare_funcs' => false
				]
			);
		}
		return self::$instance;
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

	public static function auth($guard = null) {
		return Auth::instance()->guard($guard);
	}

	public static function asset($path, $secure = null) {
		return self::instance()->_asset($path, $secure);
	}

	public static function view($viewName, $data = [], $mergeData = []) {
		return self::instance()->_view($viewName, $data, $mergeData);
	}

	public static function viewInject($views, $callback) {
		return self::instance()->_viewInject($views, $callback);
	}

	public static function trans($string, $wordpress = false) {
		return self::instance()->_trans($string, $wordpress);
	}

	public static function config($key = null, $default = null) {
		return self::instance()->_config($key, $default);
	}

	public static function notice($message = '', $type = 'info', $echo = false, $wrap = false, $class = null, $dismiss = true) {
		self::instance()->_notice($message, $type, $echo, $wrap, $class, $dismiss);
	}

	public static function buildUrl($baseUrl, $args) {
		return self::instance()->_buildUrl($baseUrl, $args);
	}

	public static function nonceName($name = null) {
		return self::instance()->_nonceName($name);
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
			return \WPSPCORE\Faker\Faker::create(Funcs::config('app.faker_locale', 'en_US'));
		}
		catch (\Exception|\Throwable $e) {
			return null;
		}
	}

	public static function locale() {
		return self::instance()->_locale();
	}

	public static function response($success = false, $data = [], $message = '', $code = 204) {
		return self::instance()->_response($success, $data, $message, $code);
	}

	public function _getAppValidation() {
		$globalValidation = $this->_getAppShortName() . '_validation';
		global ${$globalValidation};
		return ${$globalValidation};
	}

	public static function validation() {
		return Validation::instance();
	}

}