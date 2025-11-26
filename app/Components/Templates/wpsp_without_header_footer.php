<?php

namespace WPSP\App\Components\Templates;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Components\Templates\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	use InstancesTrait;

//	public $name  = 'wpsp-without-header-footer';
	public $label = 'WPSP - Page template without header and footer';
//	public $path  = null;

	public function customProperties() {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}