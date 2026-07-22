<?php

namespace WPSP\Routes;

use WPSP\App\Widen\Routes\TaxonomyColumns\TaxonomyColumns as Route;
use WPSP\App\WordPress\TaxonomyColumns\custom_column;
use WPSP\App\WordPress\TaxonomyColumns\custom_column_view;
use WPSPCORE\App\Routes\TaxonomyColumns\TaxonomyColumnsRouteTrait;

class TaxonomyColumns {

	use TaxonomyColumnsRouteTrait;

	/*
	 *
	 */

	public function taxonomy_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}