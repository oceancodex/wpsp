<?php

namespace WPSP\app\Providers;

class UsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	protected ?array $formLoginFields    = ['login'];
	protected ?array $formPasswordFields = ['password'];
	protected ?array $dbIdFields         = ['id', 'ID'];
	protected ?array $dbLoginFields      = ['username', 'email'];
	protected ?array $dbPasswordFields   = ['password'];

}