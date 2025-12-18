<?php

namespace WPSP\App\WordPress\Templates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Templates\BaseTemplates;

class wpsp_right_content extends BaseTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-right-content';
	public $label      = 'Custom page template: wpsp-right-content';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}