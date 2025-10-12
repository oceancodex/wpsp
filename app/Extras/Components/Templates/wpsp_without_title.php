<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_title extends BaseTemplates {

//	public $name  = 'wpsp-without-title';
	public $label = 'WPSP - Page template without title';
//	public $path  = null;

	public function customProperties() {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}