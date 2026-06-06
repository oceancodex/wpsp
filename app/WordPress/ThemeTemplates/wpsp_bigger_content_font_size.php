<?php

namespace WPSP\App\WordPress\ThemeTemplates;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\ThemeTemplates\BaseThemeTemplates;

class wpsp_bigger_content_font_size extends BaseThemeTemplates {

	use InstancesTrait;

//	public $name       = 'wpsp-bigger-content-font-size';
	public $label      = 'Custom template: wpsp-bigger-content-font-size';
//	public $path       = null;
	public $post_types = ['page'];

	/*
	 *
	 */

	public function customProperties(Request $request) {
//		$this->path = Funcs::instance()->_getResourcesPath('/views/theme-templates/' . $this->name . '.blade.php');
	}

}