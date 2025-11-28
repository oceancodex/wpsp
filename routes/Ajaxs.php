<?php
namespace WPSP\routes;

use WPSP\App\Http\Controllers\AjaxsController;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Http\Middleware\ApiTokenAuthentication;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\FrontendMiddleware;
use WPSP\App\Instances\Routes\Ajaxs as Route;
use WPSPCORE\Routes\Ajaxs\AjaxsRouteTrait;

class Ajaxs {

	use AjaxsRouteTrait;

	/*
	 *
	 */

	public function ajaxs() {
//		Route::get('demo_ajax_get', [AjaxsController::class, 'ajaxDemoGet'], ['nopriv' => true])->name('demo_ajax_get');
//		Route::post('demo_ajax_post', [AjaxsController::class, 'ajaxDemoGet'], ['nopriv' => true])->name('demo_ajax_post');
		Route::prefix('users')->name('users.')->middleware(AuthenticationMiddleware::class)->group(function() {
			Route::get('list', [AjaxsController::class, 'ajaxUsersList'], ['nopriv' => true]);
//			Route::get('demo4', [AjaxsController::class, 'ajaxDemoGet'])->name('demo4');
//			Route::prefix('prefix3-child')->name('group3-child.')->middleware([
//				AdministratorCapability::class,
//				EditorCapability::class
//			])->group(function() {
//				Route::get('demo3-child', [AjaxsController::class, 'ajaxDemoGet']);
//				Route::get('demo4-child', [AjaxsController::class, 'ajaxDemoGet'])->middleware([
//					ApiTokenAuthentication::class
//				])->name('demo4-child');
//			});
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}