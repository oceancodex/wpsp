<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_without_header_footer extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-without-header-footer';
	public $label      = 'WPSP - Page template without header and footer';
//	public $path       = null;
	public $post_types = ['page'];

	public function customProperties() {
		$this->path = Funcs::instance()->_getResourcesPath('/views/theme-templates/' . $this->name . '.blade.php');
	}

}