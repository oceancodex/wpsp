<?php

namespace WPSP\app\Extend\Components\Shortcodes;

use WPSPCORE\Base\BaseShortcode;

class rewrite_front_page_content extends BaseShortcode {

	public function init($atts, $content, $tag): string {
//		global $wp_query;
//		echo '<pre>'; print_r($wp_query->query_vars); echo '</pre>';
		$rewriteIdent = get_query_var(config('app.short_name') . '_rewrite_ident');
		if ($rewriteIdent) {
			$page = str_replace('_', '-', $rewriteIdent);
			return view('modules.web.rewrite-front-pages.' . $page);
		}
		return 'Rewrite front page content...';
	}

}