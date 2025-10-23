<?php

namespace WPSP\app\Extras\Components\UserMetaBoxes;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseUserMetaBox;

class custom_user_meta_box extends BaseUserMetaBox {

	use InstancesTrait;

//	public $id     = 'custom_user_meta_box';
	public $title  = 'Custom user meta box: custom_user_meta_box';
	public $update = true;

	/*
	 *
	 */

	public function customProperties() {
//		$this->title = 'Custom user meta box: custom_user_meta_box';
	}

	/*
	 *
	 */

	public function index($user) {
		$requestParams = $this->request->query->all();
		if (isset($_GET['user_id'])) {
			$editUserURL = add_query_arg('user_id', (int)$_GET['user_id'], admin_url('user-edit.php'));
		}
		else {
			$editUserURL = admin_url('profile.php') . '?';
		}
		echo Funcs::view('modules.user-meta-boxes.custom_user_meta_box.main', compact('user'))->with([
			'id'            => $this->id,
			'title'         => $this->title,
			'edit_user_url' => $editUserURL,
			'requestParams' => $requestParams,
		]);
	}

	public function update($userId) {
		if (!current_user_can('edit_user', $userId)) {
			return false;
		}

		if (isset($_POST['phone'])) {
			update_user_meta($userId, 'phone', sanitize_text_field($_POST['phone']));
		}
		return true;
	}

	/*
	 *
	 */

	public function styles() {
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-grid',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);

		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts() {}

	public function localizeScripts() {}

}