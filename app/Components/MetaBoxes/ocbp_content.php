<?php

namespace OCBP\app\Components\MetaBoxes;

use OCBPCORE\Base\BaseMetaBox;

class ocbp_content extends BaseMetaBox {

	public mixed $title         = 'OCBP Content';
	public mixed $screen        = 'ocbp';
//	public mixed $context       = 'advanced';
//	public mixed $priority      = 'default';
//	public mixed $callback_args = null;

	public function content($post, $meta_box): void {
		echo view('modules.web.meta-boxes.ocbp', compact('post', 'meta_box'));
	}

	public function customProperties(): void {
	}

}