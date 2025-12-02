<?php

namespace WPSP\App\WP\Templates;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\App\WP\Templates\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-bigger-content-font-size';
	public $label = 'Custom page template: wpsp-bigger-content-font-size';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath(). '/views/modules/templates/' . $this->name . '.blade.php';
	}

}