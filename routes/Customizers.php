<?php
namespace WPSP\routes;

use WPSP\App\Widen\Routes\Customizers\Customizers as Route;
use WPSP\App\WordPress\Customizers\customize_demo\customize_demo;
use WPSPCORE\App\Routes\Customizers\CustomizersRouteTrait;

class Customizers {

	use CustomizersRouteTrait;

	/*
	 *
	 */

	public function customizers() {
		Route::customize('customize_demo', [customize_demo::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}