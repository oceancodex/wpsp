<?php

namespace WPSP\App\Widen\Translation;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\Translation\BaseWPTranslation;

/**
 * @property self|null $instance
 */
class WPTranslation extends BaseWPTranslation {

	use InstancesTrait;

//	public $textDomain = null;
//	public $relPath    = null;

	public static function init() {
		return static::instance()->prepare();
	}

}