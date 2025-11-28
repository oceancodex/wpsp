<?php

namespace WPSP\routes;

use WPSP\App\WP\PostTypes\wpsp_content;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\PostTypes\PostTypesRouteTrait;

class PostTypes extends BaseRoute {

	use InstancesTrait, PostTypesRouteTrait;

	public function post_types() {
		$this->post_type('wpsp_content', [wpsp_content::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
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