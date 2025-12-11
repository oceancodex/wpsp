<?php

namespace WPSP\App\Extends\Translation;

use WPSP\App\Extends\Traits\InstancesTrait;
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