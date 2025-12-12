<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\Taxonomies\Taxonomies as Route;
use WPSP\App\WordPress\Taxonomies\wpsp_category;
use WPSPCORE\App\Routes\Taxonomies\TaxonomiesRouteTrait;

class Taxonomies {

	use TaxonomiesRouteTrait;

	public function taxonomies() {
		Route::taxonomy('wpsp_category', [wpsp_category::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}