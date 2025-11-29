<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\Taxonomies\Taxonomies as Route;
use WPSP\App\WP\Taxonomies\wpsp_category;
use WPSPCORE\Routes\Taxonomies\TaxonomiesRouteTrait;

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