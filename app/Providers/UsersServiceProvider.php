<?php

namespace WPSP\app\Providers;

class UsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	public ?array $formLoginFields    = ['login'];
	public ?array $formPasswordFields = ['password'];
	public ?array $dbIdFields         = ['id', 'ID'];
	public ?array $dbLoginFields      = ['username', 'email'];
	public ?array $dbPasswordFields   = ['password'];

}