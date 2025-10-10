<?php

namespace WPSP\app\Traits;

use WPSP\Funcs;

trait ModelsTrait {

	public $roleModel;
	public $permissionModel;
	public $funcs;

	public function __construct($attributes = []) {
		$this->funcs           = Funcs::instance();
		$this->roleModel       = Funcs::config('permission.models.role');
		$this->permissionModel = Funcs::config('permission.models.permission');
		$this->connection      = Funcs::instance()->_getAppShortName() . '_' . $this->connection;
		$this->customPrefix();
		parent::__construct($attributes);
	}

	protected function customPrefix(): void {
		if (!empty($this->prefix)) {
			$this->getConnection()->setTablePrefix($this->prefix);
		}
	}

}