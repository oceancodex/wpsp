<?php

namespace WPSP\app\Components\Templates;

use WPSPCORE\Base\BaseTemplates;

class wpsp_without_title extends BaseTemplates {

	public mixed $templateLabel         = 'WPSP - Page template without title';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
		$this->templatePath = WPSP_RESOURCES_PATH. '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}