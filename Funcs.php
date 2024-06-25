<?php
namespace WPSP;

class Funcs extends \WPSPCORE\Funcs {

	protected ?string     $rootNamespace = __NAMESPACE__;
	protected ?string     $mainPath      = __DIR__;
	private static ?Funcs $instance      = null;

	/**
	 * Instance.
	 *
	 * @return Funcs|null
	 */

	public static function instance(): ?Funcs {
		if (!self::$instance) {
			self::$instance = new Funcs(__DIR__);
		}
		return self::$instance;
	}

	/**
	 * Custom functions.
	 */

}