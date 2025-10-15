<?php

namespace wpsp\app\Events;

class UsersCreatedEvent {

	public $user;

	public function __construct($user) {
		$this->user = $user;
	}

}