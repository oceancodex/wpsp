<?php

namespace OCBP\app\Components\Templates;

use OCBPCORE\Base\BaseTemplates;

class ocbp_without_header_footer extends BaseTemplates {

	public mixed $templateLabel         = 'OCBP - Page template without header and footer';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
		$this->templatePath = OCBP_RESOURCES_PATH. '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}