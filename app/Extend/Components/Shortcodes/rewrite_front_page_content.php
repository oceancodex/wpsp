<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseShortcode;

class rewrite_front_page_content extends BaseShortcode {

	use InstancesTrait;

//	public mixed $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag): string {
//		global $wp_query;
//		echo '<pre>'; print_r($wp_query->query_vars); echo '</pre>';
		$rewriteIdent = get_query_var(Funcs::config('app.short_name') . '_rewrite_ident');
		if ($rewriteIdent) {
			$page = str_replace('_', '-', $rewriteIdent);
			return Funcs::view('modules.rewrite-front-pages.' . $page);
		}
		return 'Rewrite front page content...';
	}


	/*
	 *
	 */

	public function customProperties(): void {
//		$this->shortcode = 'custom_shortcode';
	}

}