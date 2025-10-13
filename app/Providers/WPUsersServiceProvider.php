<?php

namespace WPSP\app\Providers;

class WPUsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	public $formLoginFields    = ['login'];
	public $formPasswordFields = ['password'];
	public $dbIdFields         = ['ID'];
	public $dbLoginFields      = ['user_login', 'user_email'];
	public $dbPasswordFields   = ['user_pass'];
	public $dbTokenFields      = ['api_token'];

}