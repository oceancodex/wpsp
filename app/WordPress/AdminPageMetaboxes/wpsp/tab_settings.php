<?php

namespace WPSP\App\WordPress\AdminPageMetaboxes\wpsp;

use WPSPCORE\App\WordPress\AdminPageMetaboxes\AdminPageMetaboxGroup;
use WPSPCORE\App\WordPress\AdminPageMetaboxes\BaseAdminPageMetabox;

class tab_settings extends BaseAdminPageMetabox implements AdminPageMetaboxGroup {

	public function adminMetaboxes() {
		return [

		];
	}

	public function render() {
		echo '123';
	}

}