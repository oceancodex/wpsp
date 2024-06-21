<?php

namespace OCBP\app\Components\Shortcodes;

use OCBPCORE\Base\BaseShortcode;

class custom_shortcode extends BaseShortcode {

	public function init($atts, $content, $tag) {
		return view('modules.web.shortcodes.custom_shortcode')->render();
	}

}