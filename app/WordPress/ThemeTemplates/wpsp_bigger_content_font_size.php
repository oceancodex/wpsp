<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_bigger_content_font_size extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-bigger-content-font-size';
	public $label      = 'Custom page template: wpsp-bigger-content-font-size';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/modules/theme-templates/' . $this->name . '.blade.php');
	}

}