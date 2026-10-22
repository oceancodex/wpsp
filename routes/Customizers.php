<?php
namespace WPSP\Routes;

use WPSP\App\Widen\Routes\Customizers\Customizers as Route;
use WPSP\App\WordPress\Customizers\customize_demo\customize_demo;
use WPSPCORE\App\Routes\Customizers\CustomizersRouteTrait;

class Customizers {

	use CustomizersRouteTrait;

	/*
	 *
	 */

	public function customizers() {
//		Route::name('wpsp-customize.')->prefix('wpsp-customize')->group(function() {
			Route::customize('customize_demo', [customize_demo::class]);
//		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}