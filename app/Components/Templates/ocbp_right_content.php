<?php

namespace OCBP\app\Components\Templates;

use OCBPCORE\Base\BaseTemplates;

class ocbp_right_content extends BaseTemplates {

	public mixed $templateLabel         = 'Custom page template: ocbp-right-content';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
//		$this->templatePath = OCBP_RESOURCES_PATH. '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}