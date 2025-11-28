<?php

namespace WPSP\routes;

use WPSP\App\WP\Templates\wpsp_bigger_content_font_size;
use WPSP\App\WP\Templates\wpsp_center_content;
use WPSP\App\WP\Templates\wpsp_right_content;
use WPSP\App\WP\Templates\wpsp_without_header_footer;
use WPSP\App\WP\Templates\wpsp_without_title;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Templates\TemplatesRouteTrait;

class Templates extends BaseRoute {

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