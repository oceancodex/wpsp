<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\UserMetaBoxesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\UserMetaBoxes\custom_user_meta_box;

class UserMetaBoxes extends BaseRouter {

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