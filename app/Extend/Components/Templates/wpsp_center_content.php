<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	use InstancesTrait;

	public mixed $label = 'WPSP - Page template center content';
//	public mixed $path  = null;

	public function customProperties(): void {
//		$this->path = Constants::getResourcesPath() . '/views/modules/web/templates/' . $this->name . '.blade.php';
	}

}