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

	public function customProperties(): void {
//		$this->textDomain = Funcs::instance()->_getTextDomain();
//		$this->relPath    = Funcs::instance()->_getTextDomain() . '/resources/lang/';
	}

}