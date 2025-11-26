<?php
namespace WPSP\routes;

use WPSP\App\Http\Controllers\AjaxsController;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Http\Middleware\ApiTokenAuthentication;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Instances\Routes\Ajaxs as Route;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Ajaxs\AjaxsRouteTrait;

class Ajaxs extends BaseRoute {

	use InstancesTrait, AjaxsRouteTrait;

	/*
	 *
	 */

	public function ajaxs() {
		Route::get('demo1', [AjaxsController::class, 'ajaxDemoGet'])->middleware(AdministratorCapability::class)->name('demo1');
		Route::prefix('prefix2')->get('demo2', [AjaxsController::class, 'ajaxDemoGet'])->middleware(AdministratorCapability::class)->name('demo2');

		Route::prefix('prefix3')->name('group3.')->middleware([
			AdministratorCapability::class,
			EditorCapability::class,
			AuthenticationMiddleware::class
		])->group(function() {
			Route::get('demo3', [AjaxsController::class, 'ajaxDemoGet']);
			Route::get('demo4', [AjaxsController::class, 'ajaxDemoGet'])->name('demo4');
			Route::prefix('prefix3-child')->name('group3-child.')->middleware([AdministratorCapability::class, EditorCapability::class])->group(function() {
				Route::get('demo3-child', [AjaxsController::class, 'ajaxDemoGet']);
				Route::get('demo4-child', [AjaxsController::class, 'ajaxDemoGet'])->middleware([ApiTokenAuthentication::class])->name('demo4-child');
			});
		});
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}