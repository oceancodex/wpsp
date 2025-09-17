<?php

namespace WPSP\app\Extends\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	use InstancesTrait;

	public mixed $label = 'WPSP - Page template without header and footer';
//	public mixed $path  = null;

	public function customProperties(): void {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}