<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\RewriteFrontPagesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\RewriteFrontPages\wpsp;
use WPSP\app\Extras\Components\RewriteFrontPages\wpsp_with_template;

class RewriteFrontPages extends BaseRoute {

	use RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		$this->get('wpsp\/([^\/]+)\/?$', [wpsp::class, 'index'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->post('wpsp\/([^\/]+)\/?$', [wpsp::class, 'update'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->get('wpsp-with-template\/?$', [wpsp_with_template::class, 'index'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}