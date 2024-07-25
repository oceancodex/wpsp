<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\TaxonomiesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\Taxonomies\wpsp_category;

class Taxonomies extends BaseRoute {

	use TaxonomiesRouteTrait, InstancesTrait;

	public function taxonomies(): void {
		$this->taxonomy('wpsp_category', [wpsp_category::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}