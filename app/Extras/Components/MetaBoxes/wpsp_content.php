<?php

namespace WPSP\app\Extras\Components\MetaBoxes;

use WPSP\Funcs;
use WPSPCORE\Base\BaseMetaBox;

class wpsp_content extends BaseMetaBox {

	public mixed $title         = 'WPSP Content';
	public mixed $screen        = 'wpsp_content';
//	public mixed $context       = 'advanced';
//	public mixed $priority      = 'default';
//	public mixed $callback_args = null;

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