<?php

if (!trait_exists('\WPSPCORE\Permission\Traits\UserPermissionTrait')) {
	eval('namespace WPSPCORE\Permission\Traits; trait UserPermissionTrait {}');
}

if (!trait_exists('\WPSPCORE\Permission\Traits\DBUserPermissionTrait')) {
	eval('namespace WPSPCORE\Permission\Traits; trait DBUserPermissionTrait {}');
}

if (!class_exists('\WPSPCORE\Database\Base\BaseModel')) {
	eval('namespace WPSPCORE\Database\Base; class BaseModel {}');
}