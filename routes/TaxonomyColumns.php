<?php

namespace WPSP\routes;

use WPSP\App\Extends\Routes\TaxonomyColumns\TaxonomyColumns as Route;
use WPSP\App\WordPress\TaxonomyColumns\custom_column;
use WPSPCORE\App\Routes\TaxonomyColumns\TaxonomyColumnsRouteTrait;

class TaxonomyColumns {

	use TaxonomyColumnsRouteTrait;

	public function taxonomy_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}