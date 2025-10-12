<?php

if (!trait_exists(\WPSPCORE\Permission\Traits\UserPermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait UserPermissionTrait {}');
}

if (!trait_exists(\WPSPCORE\Permission\Traits\DBUserPermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait DBUserPermissionTrait {}');
}

if (!trait_exists(\WPSPCORE\Database\Base\BaseModel::class)) {
	eval('namespace WPSPCORE\Database\Base; class BaseModel {}');
}