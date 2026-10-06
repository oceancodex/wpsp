<?php

namespace WPSP\App\WordPress\MetaBoxes;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\Widen\Support\Facades\Request;
use WPSPCORE\App\WordPress\MetaBoxes\BaseMetaBox;

class wpsp_dashboard_metabox extends BaseMetaBox {

	use InstancesTrait;

	public $title         = 'WPSP Dashboard Metabox';
	public $screen        = 'dashboard';
	public $context       = 'normal';
	public $priority      = 'core';
//	public $callback_args = [];

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {}

	/*
	 *
	 */

	public function customProperties(Request $request) {
//		$this->title = 'WPSP Content';
	}

	/*
	 *
	 */

	public function index($post, $meta_box, Request $request) {
		echo 'This widget created by add_meta_box() function.';
	}

}