<?php

namespace WPSP\app\Events;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseInstances;

class UsersCreatedEvent extends BaseInstances {

	use InstancesTrait;

	public $user;

	public function __construct($user, $referrer = null, $ipAddress = null) {
		parent::__construct();
		$this->user = $user;
	}

}