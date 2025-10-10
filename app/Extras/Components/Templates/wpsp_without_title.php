<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_title extends BaseTemplates {

	use InstancesTrait;

	public mixed $label = 'WPSP - Page template without title';
//	public mixed $path  = null;

	public function customProperties(): void {
		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/templates/' . $this->name . '.blade.php');
	}

}