<?php

namespace WPSP\app\Extends\Components\Shortcodes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseShortcode;

class wpsp_content extends BaseShortcode {

	use InstancesTrait;

//	public mixed $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag): string {
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

	public function customProperties(): void {
//		$this->shortcode = 'custom_shortcode';
	}

}