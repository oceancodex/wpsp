<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	public mixed $label = 'WPSP - Page template without header and footer';
//	public mixed $path  = null;

	public function customProperties(): void {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}