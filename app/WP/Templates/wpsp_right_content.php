<?php

namespace WPSP\App\WP\Templates;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\app\WP\Templates\BaseTemplates;

class wpsp_right_content extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-right-content';
	public $label = 'Custom page template: wpsp-right-content';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}