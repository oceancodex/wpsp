<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\PostTypesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\PostTypes\wpsp_content;

class PostTypes extends BaseRoute {

	use PostTypesRouteTrait, InstancesTrait;

	public function post_types(): void {
		$this->post_type('wpsp_content', [wpsp_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}