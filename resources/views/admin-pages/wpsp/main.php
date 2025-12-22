<?php
if (isset($requestParams['tab']) && $requestParams['tab'] == 'license') {
	$title = wpsp_trans('License key', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/license.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'database') {
	$title = wpsp_trans('Database', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/database.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'settings') {
	$title = wpsp_trans('Settings', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/settings.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'tools') {
	$title = wpsp_trans('Tools', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/tools.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'table') {
	$title = wpsp_trans('Table', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/table.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'roles') {
	$title = wpsp_trans('Roles', true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.roles.index', ['action' => 'create'], true) . '" class="page-title-action">' . wpsp_trans('Add new', true) . '</a>';
	$afterTitle .= ' <a href="' . wpsp_route('AdminPages', 'wpsp.roles.index', ['action' => 'refresh'], true) . '" class="page-title-action button-primary">' . wpsp_trans('Refresh all custom roles', true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/roles.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'permissions') {
	$title = wpsp_trans('Permissions', true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.permissions.index', ['action' => 'create'], true) . '" class="page-title-action">' . wpsp_trans('Add new', true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/permissions.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'users') {
	$title = wpsp_trans('Users', true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.users.create', true) . '" class="page-title-action">' . wpsp_trans('Add new', true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/users.php');
}
else {
	$title = wpsp_trans('Dashboard', true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/dashboard.php');
}

$navigation = wpsp_resources_path('/views/admin-pages/wpsp/navigation.php');

include wpsp_resources_path('/views/admin-pages/header.php');
include $view;
include wpsp_resources_path('/views/admin-pages/footer.php');