<?php

namespace WPSP\Routes;

use WPSP\App\Widen\Routes\PluginColumns\PluginColumns as Route;
use WPSP\App\WordPress\PluginColumns\custom_column;
use WPSP\App\WordPress\PluginColumns\custom_column_view;
use WPSPCORE\App\Routes\PluginColumns\PluginColumnsRouteTrait;

class PluginColumns {

	use PluginColumnsRouteTrait;

	/*
	 *
	 */

	public function plugin_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}