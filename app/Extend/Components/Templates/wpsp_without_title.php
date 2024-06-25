<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_title extends BaseTemplates {

	public mixed $templateLabel         = 'WPSP - Page template without title';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
		$this->templatePath = Funcs::instance()->getResourcesPath() . '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}