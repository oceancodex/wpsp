<?php

if (!trait_exists('\WPSPCORE\Permission\Traits\UserPermissionTrait')) {
	eval('namespace WPSPCORE\Permission\Traits; trait UserPermissionTrait {}');
}

if (!trait_exists('\WPSPCORE\Permission\Traits\DBUserPermissionTrait')) {
	eval('namespace WPSPCORE\Permission\Traits; trait DBUserPermissionTrait {}');
}

if (!trait_exists('\Illuminate\Database\Eloquent\SoftDeletes')) {
	eval('namespace Illuminate\Database\Eloquent; trait SoftDeletes {}');
}

if (!trait_exists('\WPSPCORE\Auth\Traits\VirtualAttributesTrait')) {
	eval('namespace WPSPCORE\Auth\Traits; trait VirtualAttributesTrait {}');
}

if (!trait_exists('\WPSPCORE\Sanctum\Traits\UserSanctumTokensTrait')) {
	eval('namespace WPSPCORE\Sanctum\Traits; trait UserSanctumTokensTrait {}');
}

if (!class_exists('\WPSPCORE\Database\Base\BaseModel')) {
	eval('namespace WPSPCORE\Database\Base; class BaseModel {}');
}