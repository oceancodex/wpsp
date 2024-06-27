<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShortcode;

class wpsp_content extends BaseShortcode {

	use InstancesTrait;

	public function init($atts, $content, $tag): string {
		if (isset($atts['id'])) {
			$content = get_post($atts['id']);
			$content = $content->post_content;
		}
		return do_shortcode($content);
	}

}