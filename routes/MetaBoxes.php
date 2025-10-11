<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\MetaBoxesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\MetaBoxes\wpsp_content;

class MetaBoxes extends BaseRoute {

	use MetaBoxesRouteTrait;

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

	public function actions() {}

	public function filters() {}

}