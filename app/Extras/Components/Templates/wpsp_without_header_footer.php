<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

//	public $name  = 'wpsp-without-header-footer';
	public $label = 'WPSP - Page template without header and footer';
//	public $path  = null;

	public function customProperties() {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}