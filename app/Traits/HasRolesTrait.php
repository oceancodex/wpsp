<?php

namespace WPSP\app\Traits;

use WPSP\app\Models\ModelHasRolesModel;
use WPSP\app\Models\RolesModel;
use WPSP\Funcs;

trait HasRolesTrait {
	public function roles() {
		return $this->hasManyThrough(RolesModel::class, ModelHasRolesModel::class, 'model_id', 'id', 'ID', 'role_id');
	}
}