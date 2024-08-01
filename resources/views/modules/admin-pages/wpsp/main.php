<?php
if ($requestParams['tab'] == 'license') {
	$title = wpsp_trans('License key', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/license.php');
}
elseif ($requestParams['tab'] == 'database') {
	$title = wpsp_trans('Database', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/database.php');
}
elseif ($requestParams['tab'] == 'settings') {
	$title = wpsp_trans('Settings', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/settings.php');
}
elseif ($requestParams['tab'] == 'tools') {
	$title = wpsp_trans('Tools', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/tools.php');
}
elseif ($requestParams['tab'] == 'table') {
	$title = wpsp_trans('Table', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/table.php');
}
else {
	$title = wpsp_trans('Dashboard', true);
	$view  = wpsp_resources_path('/views/modules/admin-pages/wpsp/dashboard.php');
}

include wpsp_resources_path('/views/modules/admin-pages/header.php');
include $view;
include wpsp_resources_path('/views/modules/admin-pages/footer.php');
?>