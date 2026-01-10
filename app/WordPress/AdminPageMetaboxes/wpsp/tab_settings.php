<?php

namespace WPSP\App\WordPress\AdminPageMetaboxes\wpsp;

use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPageMetaboxes\AdminPageMetaboxGroup;
use WPSPCORE\App\WordPress\AdminPageMetaboxes\BaseAdminPageMetabox;

class tab_settings extends BaseAdminPageMetabox {

	public function adminMetaboxes(): array {
		return [
			'wpsp_settings_form'   => Funcs::view('admin-page-metaboxes.wpsp.settings.form'),
			'wpsp_settings_submit' => Funcs::view('admin-page-metaboxes.wpsp.settings.submit'),
		];
	}

}