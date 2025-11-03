<?php

namespace WPSP\app\Workers\Translation;

use WPSP\Funcs;
use WPSPCORE\Base\BaseWPTranslation;

/**
 * @property self|null $instance
 */
class WPTranslation extends BaseWPTranslation {

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
					'funcs' => Funcs::instance(),
				]
			));
		}
		return static::$instance;
	}

}