<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\TaxonomiesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\Taxonomies\wpsp_category;

class Taxonomies extends BaseRouter {

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

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}