<?php

namespace WPSP\App\WP\MetaBoxes;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WP\MetaBoxes\BaseMetaBox;

class wpsp_content extends BaseMetaBox {

	use InstancesTrait;

	public $title         = 'WPSP Content';
	public $screen        = 'wpsp_content';
//	public $context       = 'advanced';
//	public $priority      = 'default';
//	public $callback_args = [];

	/*
	 *
	 */

	public function customProperties() {
//		$this->title = 'WPSP Content';
	}

	/*
	 *
	 */

	public function index($post, $meta_box) {
		echo Funcs::view('modules.meta-boxes.wpsp', compact('post', 'meta_box'));
	}

}