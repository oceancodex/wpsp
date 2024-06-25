<?php

namespace WPSP\app\Extend\Components\Translation;

class Translator {

	public static function init(): void {
		load_plugin_textdomain(\WPSP\Funcs::instance()->getTextDomain(), false, \WPSP\Funcs::instance()->getMainBaseName() . '/resources/lang/');
	}

}