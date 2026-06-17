<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Mail\Mailer as MailerCore;

class Mail extends MailerCore {

	use InstancesTrait;

	/** @var MailerCore|null */
	public static $instance  = null;

	/**
	 * @return MailerCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setMail();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}