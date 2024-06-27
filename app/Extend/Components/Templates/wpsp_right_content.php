<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_right_content extends BaseTemplates {

	use InstancesTrait;

	public mixed $templateLabel         = 'Custom page template: wpsp-right-content';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
//		$this->templatePath = Constants::getResourcesPath() . '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}