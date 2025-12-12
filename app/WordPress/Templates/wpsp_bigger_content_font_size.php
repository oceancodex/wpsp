<?php

namespace WPSP\App\WordPress\Templates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Templates\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-bigger-content-font-size';
	public $label = 'Custom page template: wpsp-bigger-content-font-size';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath(). '/views/modules/templates/' . $this->name . '.blade.php';
	}

}