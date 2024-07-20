<?php

namespace WPSP\app\Extend\Instances\Translator;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseTranslator;

class Translator extends BaseTranslator {

//	public ?string $textDomain = null;
//	public ?string $relPath    = null;

	use InstancesTrait;

	/*
	 *
	 */

	protected function afterInstanceConstruct(): void {
//		$this->textDomain = Funcs::instance()->_getTextDomain();
//		$this->relPath    = Funcs::instance()->_getTextDomain() . '/resources/lang/';
	}

	/*
	 *
	 */

	public static function init() {
		self::instance()->prepare()->global();
	}

	public static function instance(): ?self {
		if (!self::$instance) {
			self::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return self::$instance;
	}

}