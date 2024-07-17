<?php

namespace WPSP\app\Traits;

use WPSP\Funcs;

trait ModelsTrait {

	public function __construct($attributes = []) {
		$this->connection = Funcs::instance()->_getAppShortName() . '_' . $this->connection;
		parent::__construct($attributes);
	}

}