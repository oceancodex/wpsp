<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\TemplatesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\Templates\wpsp_bigger_content_font_size;
use WPSP\App\Components\Templates\wpsp_center_content;
use WPSP\App\Components\Templates\wpsp_right_content;
use WPSP\App\Components\Templates\wpsp_without_header_footer;
use WPSP\App\Components\Templates\wpsp_without_title;

class Templates extends BaseRouter {

	use InstancesTrait, TemplatesRouteTrait;

	/*
	 *
	 */

	public function templates() {
		$this->template('wpsp-without-title', [wpsp_without_title::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-center-content', [wpsp_center_content::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-without-header-footer', [wpsp_without_header_footer::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-right-content', [wpsp_right_content::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-bigger-content-font-size', [wpsp_bigger_content_font_size::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}