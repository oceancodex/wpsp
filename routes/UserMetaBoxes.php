<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\UserMetaBoxesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\UserMetaBoxes\custom_user_meta_box;

class UserMetaBoxes extends BaseRoute {

	use InstancesTrait, UserMetaBoxesRouteTrait;

	/*
	 *
	 */

	public function user_meta_boxes() {
		$this->meta_box('custom_user_meta_box', [custom_user_meta_box::class, 'index'], true, null, [
			[AdministratorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}