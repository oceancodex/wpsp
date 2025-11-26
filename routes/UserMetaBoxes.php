<?php

namespace WPSP\routes;

use WPSP\App\Components\UserMetaBoxes\custom_user_meta_box;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\UserMetaBoxes\UserMetaBoxesRouteTrait;

class UserMetaBoxes extends BaseRoute {

	use InstancesTrait, UserMetaBoxesRouteTrait;

	/*
	 *
	 */

	public function user_meta_boxes() {
		$this->user_meta_box('custom_user_meta_box', [custom_user_meta_box::class, 'index'], true, null, [
			[AdministratorCapability::class, 'handle'],
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