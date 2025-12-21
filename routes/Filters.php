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

}