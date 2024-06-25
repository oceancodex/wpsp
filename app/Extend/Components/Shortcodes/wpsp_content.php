<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSPCORE\Base\BaseShortcode;

class wpsp_content extends BaseShortcode {

	public function init($atts, $content, $tag): string {
		if (isset($atts['id'])) {
			$content = get_post($atts['id']);
			$content = $content->post_content;
		}
		return do_shortcode($content);
	}

}