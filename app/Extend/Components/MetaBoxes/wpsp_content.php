<?php

namespace WPSP\app\Extend\Components\MetaBoxes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMetaBox;

class wpsp_content extends BaseMetaBox {

	use InstancesTrait;

	public mixed $title         = 'WPSP Content';
	public mixed $screen        = 'wpsp';
//	public mixed $context       = 'advanced';
//	public mixed $priority      = 'default';
//	public mixed $callback_args = null;

	public function content($post, $meta_box): void {
		echo Funcs::view('modules.web.meta-boxes.wpsp', compact('post', 'meta_box'));
	}

	public function customProperties(): void {
//		$this->title = 'WPSP Content';
	}

}