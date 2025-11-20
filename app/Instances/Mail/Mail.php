<?php

namespace WPSP\App\Instances\Mail;

use Illuminate\Support\Facades\Facade;

class Mail extends Facade {

	protected static function getFacadeAccessor(): string {
		return 'mailer';
	}

}
