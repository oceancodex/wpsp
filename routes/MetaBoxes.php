<?php

namespace WPSP\routes;

use WPSP\App\WP\MetaBoxes\wpsp_content;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\MetaBoxes\MetaBoxesRouteTrait;

class MetaBoxes extends BaseRoute {

	use InstancesTrait, MetaBoxesRouteTrait;

	/*
	 *
	 */

	public function meta_boxes() {
		$this->meta_box('wpsp_shortcode', [wpsp_content::class, 'index'], true, null, [
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