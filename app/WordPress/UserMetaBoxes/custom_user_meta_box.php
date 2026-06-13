<?php

namespace WPSP\App\WordPress\UserMetaBoxes;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\UserMetaBoxes\BaseUserMetaBox;

class custom_user_meta_box extends BaseUserMetaBox {

	use InstancesTrait;

//	public $id       = 'custom_user_meta_box';
	public $title    = 'Custom user meta box: custom_user_meta_box';

//	public $update_priority      = 10;
//	public $update_accepted_args = 1;

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {}

	/*
	 *
	 */

	public function customProperties() {
//		$this->title = 'Custom user meta box: custom_user_meta_box';
	}

	/*
	 *
	 */

	public function index($user, Request $request) {
		$requestParams = $this->request->query->all();

		if (isset($_GET['user_id'])) {
			$editUserURL = add_query_arg('user_id', (int)$_GET['user_id'], admin_url('user-edit.php'));
		}
		else {
			$editUserURL = admin_url('profile.php') . '?';
		}

		echo Funcs::view('user-meta-boxes.custom_user_meta_box.main', compact('user'))->with([
			'id'            => $this->id,
			'title'         => $this->title,
			'editUserURL'   => $editUserURL,
			'requestParams' => $requestParams,
		]);
	}

	public function update($user_id, Request $request) {
		if (!current_user_can('edit_user', $user_id)) {
			return false;
		}

		if (isset($_POST['phone'])) {
			update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
		}
		return true;
	}

	/*
	 *
	 */

	public function styles() {
		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-grid',
			Funcs::instance()->_getPublicUrl() . '/widen/plugins/bootstrap/css/bootstrap-grid.min.css',
			null,
			Funcs::instance()->_getVersion()
		);

		wp_enqueue_style(
			Funcs::config('app.short_name') . '-bootstrap-utilities',
			Funcs::instance()->_getPublicUrl() . '/widen/plugins/bootstrap/css/bootstrap-utilities.min.css',
			null,
			Funcs::instance()->_getVersion()
		);
	}

	public function scripts() {}

	public function localizeScripts() {}

}