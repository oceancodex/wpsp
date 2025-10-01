<?php

namespace wpsp\app\Providers;

class WPUsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	protected ?array $formLoginFields    = ['login'];
	protected ?array $dbIdFields         = ['ID'];
	protected ?array $dbLoginFields      = ['user_login', 'user_email'];

}