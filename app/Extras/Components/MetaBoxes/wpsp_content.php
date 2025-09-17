<?php

namespace WPSP\app\Extras\Components\MetaBoxes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMetaBox;

class wpsp_content extends BaseMetaBox {

	use InstancesTrait;

	public $title         = 'WPSP Content';
	public $screen        = 'wpsp_content';
//	public $context       = 'advanced';
//	public $priority      = 'default';
//	public $callback_args = null;

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->title = 'WPSP Content';
	}

	/*
	 *
	 */

	public function index($post, $meta_box): void {
		echo Funcs::view('modules.meta-boxes.wpsp', compact('post', 'meta_box'));
	}

}