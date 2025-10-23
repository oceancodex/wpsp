<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-bigger-content-font-size';
	public $label = 'Custom page template: wpsp-bigger-content-font-size';
//	public $path  = null;

	public function customProperties() {
//		$this->path = Constants::getResourcesPath(). '/views/modules/templates/' . $this->name . '.blade.php';
	}

}