<?php

namespace WPSP\routes;

use WPSP\App\Http\Controllers\PagesController;
use WPSP\App\Widen\Routes\Filters\Filters as Route;
use WPSPCORE\App\Routes\Filters\FiltersRouteTrait;

class Filters {

	use FiltersRouteTrait;

	/*
	 *
	 */

	public function filters() {
//		Route::filter('the_content', [PagesController::class, 'content']);
	}

	/*
	 *
	 */

	public function wp_filters() {
		add_filter('removable_query_args', function($args) {
			$removeableQueryArgs = array_merge($args, [
				'items',
				'_wp_http_referer',
				'_wpnonce',
				'bulk_action',
				'notice_type',
				'bulk_edit',
			]);

			if (isset($_REQUEST['action']) && $_REQUEST['action'] == -1) {
				$removeableQueryArgs = array_merge($removeableQueryArgs, ['action', 'action2']);
			}

			return $removeableQueryArgs;
		});
	}

}