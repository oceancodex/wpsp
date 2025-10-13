<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\TaxonomiesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\Taxonomies\wpsp_category;

class Taxonomies extends BaseRoute {

	use InstancesTrait, TaxonomiesRouteTrait;

	public function taxonomies() {
		$this->taxonomy('wpsp_category', [wpsp_category::class], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}