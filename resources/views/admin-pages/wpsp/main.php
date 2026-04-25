<?php
if (isset($requestParams['tab']) && $requestParams['tab'] == 'license') {
	$title = wpsp_trans('License key', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/license.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'database') {
	$title = wpsp_trans('Database', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/database.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'settings') {
	$title = wpsp_trans('Settings', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/settings.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'tools') {
	$title = wpsp_trans('Tools', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/tools.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'table') {
	$title = wpsp_trans('Table', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/table.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'roles') {
	$title = wpsp_trans('Roles', null, true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.roles.index', ['action' => 'create'], true) . '" class="page-title-action">' . wpsp_trans('Add new', null, true) . '</a>';
	$afterTitle .= ' <a href="' . wpsp_route('AdminPages', 'wpsp.roles.index', ['action' => 'refresh'], true) . '" class="page-title-action button-primary">' . wpsp_trans('Refresh all custom roles', null, true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/roles.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'permissions') {
	$title = wpsp_trans('Permissions', null, true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.permissions.index', ['action' => 'create'], true) . '" class="page-title-action">' . wpsp_trans('Add new', null, true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/permissions.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'users') {
	$title = wpsp_trans('Users', null, true);
	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.users.create', true) . '" class="page-title-action">' . wpsp_trans('Add new', null, true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/users.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'activity_log') {
	$title = wpsp_trans('Activity log', null, true);
//	$afterTitle = ' <a href="' . wpsp_route('AdminPages', 'wpsp.users.create', true) . '" class="page-title-action">' . wpsp_trans('Add new', null, true) . '</a>';
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/activity_log.php');
}
else {
	$title = wpsp_trans('Dashboard', null, true);
	$view  = wpsp_resources_path('/views/admin-pages/wpsp/dashboard.php');
}

$navigation = wpsp_resources_path('/views/admin-pages/wpsp/navigation.php');

include wpsp_resources_path('/views/admin-pages/header.php');
include $view;
include wpsp_resources_path('/views/admin-pages/footer.php');