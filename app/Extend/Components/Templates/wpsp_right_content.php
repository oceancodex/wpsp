<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_right_content extends BaseTemplates {

	use InstancesTrait;

	public mixed $label = 'Custom page template: wpsp-right-content';
//	public mixed $path  = null;

	public function customProperties(): void {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}