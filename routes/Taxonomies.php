<?php

namespace WPSP\routes;

use WPSP\App\WP\Taxonomies\wpsp_category;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Taxonomies\TaxonomiesRouteTrait;

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

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}