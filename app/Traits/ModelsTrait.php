<?php

namespace WPSP\app\Traits;

use WPSP\Funcs;

trait ModelsTrait {

	protected $prefix = null;

	public function __construct($attributes = []) {
		$this->connection = Funcs::instance()->_getAppShortName() . '_' . $this->connection;
		$this->customPrefix();
		parent::__construct($attributes);
	}

	protected function customPrefix(): void {
		if ($this->prefix) {
			$this->getConnection()->setTablePrefix($this->prefix);
		}
	}

}