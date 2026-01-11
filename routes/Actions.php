<?php

namespace WPSP\routes;

use WPSP\App\Http\Controllers\AssetsController;
use WPSP\App\Http\Controllers\PagesController;
use WPSP\App\Widen\Routes\Actions\Actions as Route;
use WPSPCORE\App\Routes\Actions\ActionsRouteTrait;

class Actions {

	use ActionsRouteTrait;

	/*
	 *
	 */

	public function actions() {
//		Route::action('wp_head', [PagesController::class, 'index']);
//		Route::action('admin_enqueue_scripts', [AssetsController::class, 'backend']);
//		Route::action('current_screen', [PagesController::class, 'edit_user_screen']);
	}

}