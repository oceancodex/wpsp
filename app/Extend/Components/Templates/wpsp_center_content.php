<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSPCORE\Base\BaseTemplates;

class wpsp_center_content extends BaseTemplates {

	public mixed $templateLabel         = 'WPSP - Page template center content';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
//		$this->templatePath = Constants::getResourcesPath() . '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}