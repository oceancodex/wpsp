<?php

namespace WPSP\App\Components\Templates;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-center-content';
	public $label = 'WPSP - Page template center content';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}