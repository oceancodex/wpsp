<?php

namespace WPSP\App\Components\Shortcodes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Components\Shortcodes\BaseShortcode;

class wpsp_content extends BaseShortcode {

	use InstancesTrait;

//	public $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag) {
		if (isset($atts['id']) && $atts['id']) {
			$post = get_post($atts['id']);
			if (!empty($post)) {
				$content = $post->post_content;
			}
		}
		return do_shortcode($content);
	}


	/*
	 *
	 */

	public function customProperties() {
//		$this->shortcode = 'custom_shortcode';
	}

}