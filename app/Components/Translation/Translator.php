<?php

namespace WPSP\app\Components\Translation;

class Translator {

	public static function init(): void {
		load_plugin_textdomain(WPSP_TEXT_DOMAIN, false, WPSP_TEXT_DOMAIN . '/resources/lang/');
	}

}