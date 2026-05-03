<?php
namespace WPSP\App\Widen\Traits;

use WPSP\Funcs;

trait ModelsTrait {

	public function __construct($attributes = []) {
		parent::__construct($attributes);
		parent::setConnectionResolver(Funcs::app()->make('db'));
	}

}