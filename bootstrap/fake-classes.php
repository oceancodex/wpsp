<?php
/**
 * Fake "PermissionTrait" if not exists.
 */
if (!trait_exists(\WPSPCORE\Permission\Traits\UserPermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait UserPermissionTrait {}');
}

/**
 * Fake "DBPermissionTrait" if not exists.
 */
if (!trait_exists(\WPSPCORE\Permission\Traits\DBUserPermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait DBUserPermissionTrait {}');
}