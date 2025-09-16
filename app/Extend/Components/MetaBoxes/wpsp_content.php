<?php

namespace WPSP\app\Extend\Components\MetaBoxes;

use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMetaBox;

class wpsp_content extends BaseMetaBox {

	use InstancesTrait;

	public mixed $title         = 'WPSP Content';
	public mixed $screen        = 'wpsp_content';
//	public mixed $context       = 'advanced';
//	public mixed $priority      = 'default';
//	public mixed $callback_args = null;

//	public function __construct($mainPath = null, $rootNamespace = null, $prefixEnv = null, $id = null, $callback_function = null, $xxx = null) {
//		parent::__construct($mainPath, $rootNamespace, $prefixEnv, $id, $callback_function);
//	}

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
		echo '<pre>'; print_r($meta_box); echo '</pre>'; die();
		echo Funcs::view('modules.meta-boxes.wpsp', compact('post', 'meta_box'));
	}

}