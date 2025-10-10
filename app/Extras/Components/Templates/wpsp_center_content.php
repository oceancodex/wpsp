<?php

namespace WPSP\app\Extras\Components\Templates;

use WPSPCORE\Base\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	public mixed $label = 'WPSP - Page template center content';
//	public mixed $path  = null;

	public function customProperties(): void {
//		$this->path = Constants::getResourcesPath() . '/views/modules/templates/' . $this->name . '.blade.php';
	}

}