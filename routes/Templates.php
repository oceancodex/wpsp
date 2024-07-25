<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\TemplatesRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extend\Components\Templates\wpsp_bigger_content_font_size;
use WPSP\app\Extend\Components\Templates\wpsp_center_content;
use WPSP\app\Extend\Components\Templates\wpsp_right_content;
use WPSP\app\Extend\Components\Templates\wpsp_without_header_footer;
use WPSP\app\Extend\Components\Templates\wpsp_without_title;

class Templates extends BaseRoute {

	use TemplatesRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function templates(): void {
		$this->template('wpsp-without-title', [wpsp_without_title::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-center-content', [wpsp_center_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-without-header-footer', [wpsp_without_header_footer::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-right-content', [wpsp_right_content::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
		$this->template('wpsp-bigger-content-font-size', [wpsp_bigger_content_font_size::class, 'init'], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[EditorCapability::class, 'handle']
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}