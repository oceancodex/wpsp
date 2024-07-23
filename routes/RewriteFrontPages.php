<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\RewriteFrontPagesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\RewriteFrontPages\wpsp as RewriteFrontPage_wpsp;
use WPSP\app\Extend\Components\RewriteFrontPages\wpsp_with_template as RewriteFrontPage_wpsp_with_template;

class RewriteFrontPages extends BaseRoute {

	use RewriteFrontPagesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function rewrite_front_pages(): void {
		$this->get('wpsp\/([^\/]+)\/?$', [RewriteFrontPage_wpsp::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->post('wpsp\/([^\/]+)\/?$', [RewriteFrontPage_wpsp::class, 'update'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->get('wpsp-with-template\/?$', [RewriteFrontPage_wpsp_with_template::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}