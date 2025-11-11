<?php

namespace WPSP\App\Workers\Log;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Log extends \WPSPCORE\Log\Log {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	/**
	 * @return static|null
	 */
	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-log')) {
			return static::instance(true);

		}
		return null;
	}

	/*
	 *
	 */

	/**
	 * @return null|static
	 */
	public static function instance($init = false) {
		if ($init && !static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
		}
		return static::$instance;
	}

	/*
	 *
	 */

	/**
	 * @param $name
	 *
	 * @return static|null
	 */
	public static function channel($name = null) {
		return static::instance()->_channel($name);
	}

	public static function info($message, $context = []) {
		static::instance()->_info($message, $context);
	}

	public static function alert($message, $context = []) {
		static::instance()->_alert($message, $context);
	}

	public static function debug($message, $context = []) {
		static::instance()->_debug($message, $context);
	}

	public static function error($message, $context = []) {
		static::instance()->_error($message, $context);
	}

	public static function notice($message, $context = []) {
		static::instance()->_notice($message, $context);
	}

	public static function warning($message, $context = []) {
		static::instance()->_warning($message, $context);
	}

	public static function critical($message, $context = []) {
		static::instance()->_critical($message, $context);
	}

	public static function emergency($message, $context = []) {
		static::instance()->_emergency($message, $context);
	}

	public static function log($level, $message, $context = []) {
		static::instance()->_log($level, $message, $context);
	}

}