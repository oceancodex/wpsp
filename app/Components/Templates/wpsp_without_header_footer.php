<?php

namespace WPSP\app\Components\Templates;

use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	public mixed $templateLabel         = 'WPSP - Page template without header and footer';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
		$this->templatePath = WPSP_RESOURCES_PATH. '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}