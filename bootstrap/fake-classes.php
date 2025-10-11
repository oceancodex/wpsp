<?php
/**
 * Fake "PermissionTrait" if not exists.
 */
if (!trait_exists(\WPSPCORE\Permission\Traits\PermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait PermissionTrait {}');
}

/**
 * Fake "DBPermissionTrait" if not exists.
 */
if (!trait_exists(\WPSPCORE\Permission\Traits\DBPermissionTrait::class)) {
	eval('namespace WPSPCORE\Permission\Traits; trait DBPermissionTrait {}');
}