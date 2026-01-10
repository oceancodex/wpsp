<?php

namespace WPSP\App\WordPress\AdminPageMetaboxes\wpsp;

use Illuminate\Http\Request;
use WPSP\App\Widen\Support\Facades\View;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\AdminPageMetaboxes\BaseAdminPageMetabox;

class tab_settings extends BaseAdminPageMetabox {

	use InstancesTrait;

	/*
	 *
	 */

	public function adminPageMetaboxes(Request $request): array {
		return [
			'wpsp_settings_form'   => Funcs::view('admin-page-metaboxes.wpsp.settings.form')->render(),
			'wpsp_settings_submit' => 'admin-page-metaboxes.wpsp.settings.submit',
		];
	}

}