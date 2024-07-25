<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\MetaBoxesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\MetaBoxes\wpsp_content;

class MetaBoxes extends BaseRoute {

	use MetaBoxesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function meta_boxes(): void {
		$this->meta_box('wpsp_shortcode', [wpsp_content::class, 'init'], true, null, [
			[AdministratorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}