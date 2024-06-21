<?php

namespace OCBP\app\Components\Shortcodes;

use OCBPCORE\Base\BaseShortcode;

class ocbp_content extends BaseShortcode {

	public function init($atts, $content, $tag): string {
		if (isset($atts['id'])) {
			$content = get_post($atts['id']);
			$content = $content->post_content;
		}
		return do_shortcode($content);
	}

}