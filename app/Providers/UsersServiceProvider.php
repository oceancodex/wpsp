<?php

namespace WPSP\app\Providers;

use WPSP\app\Traits\InstancesTrait;

class UsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	use InstancesTrait;

	public $formLoginFields    = ['login'];
	public $formPasswordFields = ['password'];
	public $dbIdFields         = ['id'];
	public $dbLoginFields      = ['username', 'email'];
	public $dbPasswordFields   = ['password'];
	public $dbTokenFields      = ['api_token'];

}