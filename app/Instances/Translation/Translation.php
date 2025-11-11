<?php

namespace WPSP\App\Workers\Translation;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTranslation;

/**
 * @property static|null $instance
 */
class Translation extends BaseTranslation {

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-translation')) {
			return self::instance(true);
		}
		return null;
	}

	/**
	 * @return \Illuminate\Translation\Translator|null
	 */
	public static function instance($init = false) {
		if ($init && !static::$instance) {
			$translation = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			));
			$translation = $translation->initTranslation();
			static::$instance = $translation;
		}
		return static::$instance;
	}

}