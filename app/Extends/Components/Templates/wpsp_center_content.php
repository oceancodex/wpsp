<?php

namespace WPSP\app\Extends\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	use InstancesTrait;

	public $label = 'WPSP - Page template center content';
//	public $path  = null;

	public function customProperties(): void {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}