<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_right_content extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-right-content';
	public $label      = 'Custom page template: wpsp-right-content';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/theme-templates/' . $this->name . '.blade.php');
	}

}