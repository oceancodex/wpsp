<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTemplates;

class wpsp_bigger_content_font_size extends BaseTemplates {

	use InstancesTrait;

	public mixed $templateLabel         = 'Custom page template: wpsp-bigger-content-font-size';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
//		$this->templatePath = Constants::getResourcesPath(). '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}