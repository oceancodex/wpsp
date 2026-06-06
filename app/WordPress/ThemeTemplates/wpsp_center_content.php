<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_center_content extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-center-content';
	public $label      = 'WPSP - Template center content';
//	public $path       = null;
	public $post_types = ['page'];

	/*
	 *
	 */

	public function customProperties(Request $request) {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/theme-templates/' . $this->name . '.blade.php');
	}

}