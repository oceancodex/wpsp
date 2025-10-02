<?php

namespace wpsp\app\Providers;

class WPUsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	public ?array $formLoginFields    = ['login'];
	public ?array $formPasswordFields = ['password'];
	public ?array $dbIdFields         = ['ID'];
	public ?array $dbLoginFields      = ['user_login', 'user_email'];
	public ?array $dbPasswordFields   = ['user_pass'];
	public ?array $dbTokenFields      = ['api_token'];

}