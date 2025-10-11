<?php

namespace WPSP\app\Providers;

class UsersServiceProvider extends \WPSPCORE\Auth\Providers\AuthServiceProvider {

	public $formLoginFields    = ['login'];
	public $formPasswordFields = ['password'];
	public        $dbIdFields         = ['id'];
	public        $dbLoginFields      = ['username', 'email'];
	public        $dbPasswordFields = ['password'];
	public        $dbTokenFields    = ['api_token'];

}