<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_right_content extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-right-content';
	public $label = 'Custom page template: wpsp-right-content';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}