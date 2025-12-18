<?php

namespace WPSP\App\WordPress\Templates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Templates\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-center-content';
	public $label      = 'WPSP - Page template center content';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}