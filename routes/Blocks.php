<?php
namespace WPSP\routes;

use WPSP\App\Widen\Routes\Blocks\Blocks as Route;
use WPSP\App\WordPress\Blocks\block_one;
use WPSPCORE\App\Routes\Blocks\BlocksRouteTrait;

class Blocks {

	use BlocksRouteTrait;

	/*
	 *
	 */

	public function blocks() {
		Route::block('block-one', [block_one::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}