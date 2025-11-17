<?php

namespace WPSP\routes;

use WPSP\App\Components\RewriteFrontPages\auth;
use WPSP\App\Http\Middleware\SessionMiddleware;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\RewriteFrontPagesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\RewriteFrontPages\wpsp;
use WPSP\App\Components\RewriteFrontPages\wpsp_with_template;

class RewriteFrontPages extends BaseRoute {

	use InstancesTrait, RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		$this->name('auth.')->prefix('auth')->group(function() {
			$this->middleware(SessionMiddleware::class)->get('login', [auth::class, 'login'], true)->name('login');
		});
		$this->name('wpsp.')->group(function() {
			$this->middleware(SessionMiddleware::class)->get('wpsp\/(?P<endpoint>[^\/]+)\/?$', [wpsp::class, 'index'], true, null, [
//			    'relation' => 'OR',
//			    [AdministratorCapability::class, 'handle'],
//			    [EditorCapability::class, 'handle']
			])->name('index');
			$this->post('wpsp\/([^\/]+)\/?$', [wpsp::class, 'update'], true, null, [
//			    'relation' => 'OR',
//			    [AdministratorCapability::class, 'handle'],
//			    [EditorCapability::class, 'handle']
			]);
			$this->get('wpsp-with-template\/?$', [wpsp_with_template::class, 'index'], true, null, [
//			    'relation' => 'OR',
//			    [AdministratorCapability::class, 'handle'],
//			    [EditorCapability::class, 'handle']
			]);
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