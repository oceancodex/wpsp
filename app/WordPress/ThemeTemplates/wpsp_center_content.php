<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_center_content extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-center-content';
	public $label      = 'WPSP - Page template center content';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/theme-templates/' . $this->name . '.blade.php');
	}

}