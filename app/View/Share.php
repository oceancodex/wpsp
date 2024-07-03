<?php

namespace WPSP\app\View;

use WPSP\Funcs;
use WPSPCORE\Base\BaseShare;

class Share extends BaseShare {

	public function variables(): array {
		return [
			'user' => get_currentuserinfo(),
		];
	}

}