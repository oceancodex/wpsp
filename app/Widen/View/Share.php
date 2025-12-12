<?php

namespace WPSP\App\Widen\View;

use Illuminate\View\View;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\App\Widen\Traits\InstancesTrait;

class Share extends \WPSPCORE\App\View\Share {

	public $view = null;

	use InstancesTrait;

	public function afterConstruct() {
		$this->view = $this->funcs->getApplication('view');
	}

	public function share() {
		$this->view->share([
			'wp_user'         => wp_get_current_user(),
			'current_request' => $this->request,
			'user'            => Auth::user(),
		]);
	}

	public function compose() {
		$this->view->composer('*', function(View $view) {
			global $notice;
			$view->with('current_view_name', $view->getName());
			$view->with('notice', $notice);
		});
	}

}