<?php
if (isset($requestParams['tab']) && $requestParams['tab'] == 'license') {
	$title = $funcs->_trans('License key', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/license.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'database') {
	$title = $funcs->_trans('Database', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/database.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'settings') {
	$title = $funcs->_trans('Settings', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/settings.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'tools') {
	$title = $funcs->_trans('Tools', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/tools.php');
}
elseif (isset($requestParams['tab']) && $requestParams['tab'] == 'table') {
	$title = $funcs->_trans('Table', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/table.php');
}
else {
	$title = $funcs->_trans('Dashboard', true);
	$view  = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/dashboard.php');
}
$navigation = $funcs->_getResourcesPath('/views/modules/admin-pages/wpsp/navigation.php');

include $funcs->_getResourcesPath('/views/modules/admin-pages/header.php');
include $view;
include $funcs->_getResourcesPath('/views/modules/admin-pages/footer.php');
?>