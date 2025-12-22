<?php
namespace WPSP\routes;

use WPSP\App\Widen\Routes\Blocks\Blocks as Route;
use WPSPCORE\App\Routes\Blocks\BlocksRouteTrait;
use WPSP\App\WordPress\Blocks\block_demo;
use WPSP\App\WordPress\Blocks\block_test;

class Blocks {

	use BlocksRouteTrait;

	/*
	 *
	 */

	public function blocks() {
		Route::block('block-test', [block_test::class]);
		Route::block('block-demo', [block_demo::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}