<?php

namespace WPSP\App\WordPress\Templates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Templates\BaseTemplates;

class wpsp_without_title extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-without-title';
	public $label = 'WPSP - Page template without title';
//	public $path  = null;

	public function customProperties() {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}