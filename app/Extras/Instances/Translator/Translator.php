<?php

namespace WPSP\app\Extras\Instances\Translator;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTranslator;

class Translator extends BaseTranslator {

//	public $textDomain = null;
//	public $relPath    = null;

	/*
	 *
	 */

	public static ?self $instance = null;

	/*
	 *
	 */

	public function afterInstanceConstruct() {
//		$this->textDomain = Funcs::instance()->_getTextDomain();
//		$this->relPath    = Funcs::instance()->_getTextDomain() . '/resources/lang/';
	}

	/*
	 *
	 */

	public static function init() {
		self::instance()->prepare()->global();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

}