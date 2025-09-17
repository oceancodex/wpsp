<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	use InstancesTrait;

	public $label = 'WPSP - Page template without header and footer';
//	public $path  = null;

	public function customProperties(): void {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}