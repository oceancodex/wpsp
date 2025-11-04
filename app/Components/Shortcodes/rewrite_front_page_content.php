<?php

namespace WPSP\app\Components\Shortcodes;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseShortcode;

class rewrite_front_page_content extends BaseShortcode {

	use InstancesTrait;

//	public $shortcode = null;

	/*
	 *
	 */

	public function index($atts, $content, $tag) {
//		global $wp_query;
//		echo '<pre>'; print_r($wp_query->query_vars); echo '</pre>';
		$rewriteIdent = get_query_var(Funcs::config('app.short_name') . '_rewrite_ident');
		if ($rewriteIdent) {
			$page = str_replace('_', '-', $rewriteIdent);
			return Funcs::view('modules.rewrite-front-pages.' . $page, ['request' => $this->request]);
		}
		return 'Rewrite front page content...';
	}


	/*
	 *
	 */

	public function customProperties() {
//		$this->shortcode = 'custom_shortcode';
	}

}