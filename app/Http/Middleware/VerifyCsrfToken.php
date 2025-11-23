<?php

namespace WPSP\App\Http\Middleware;

use WPSP\App\Traits\StartSessionTrait;

class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken {

	use StartSessionTrait;

//	protected $except = [
//		'wp-json/wp/v2/settings',
//	];

//	protected $addHttpCookie = false;

	public function handle($request, \Closure $next) {
		return parent::handle($request, $next);
	}

}