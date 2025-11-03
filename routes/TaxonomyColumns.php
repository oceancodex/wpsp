<?php

namespace WPSP\routes;

use WPSP\app\Components\TaxonomyColumns\custom_column;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\TaxonomyColumnsRouteTrait;

class TaxonomyColumns extends BaseRoute {

	use InstancesTrait, TaxonomyColumnsRouteTrait;

	public function taxonomy_columns() {
		$this->column('custom_column', [custom_column::class, 'index'], true);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}