<?php

namespace WPSP\app\Extras\Instances\Translator;

use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\Funcs;
use WPSPCORE\Base\BaseTranslator;

/**
 * @property self|null $instance
 */
class Translator extends BaseTranslator {

//	public $textDomain = null;
//	public $relPath    = null;

	public static $instance = null;

	public static function init() {
		return self::instance()->prepare()->global();
	}

	/**
	 * @return self|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'       => Funcs::instance(),
					'environment' => Environment::instance(),
				]
			));
		}
		return static::$instance;
	}

}