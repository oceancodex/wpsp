<?php

namespace WPSP\app\Extend\Components\Templates;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseTemplates;

class wpsp_without_header_footer extends BaseTemplates {

	use InstancesTrait;

	public mixed $templateLabel         = 'WPSP - Page template without header and footer';
//	public mixed $templatePath          = null;

	public function customProperties(): void {
		$this->templatePath = Funcs::instance()->_getResourcesPath() . '/views/modules/web/templates/' . $this->templateName . '.blade.php';
	}

}