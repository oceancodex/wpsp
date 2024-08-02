<h2 class="nav-tab-wrapper">
	<a href="?page={{$menuSlug}}&tab=dashboard" class="nav-tab {{ !isset($requestParams['tab']) || $requestParams['tab'] == 'dashboard' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.dashboard') }}</a>
	<a href="?page={{$menuSlug}}&tab=license" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'license' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.license_key') }}</a>
	<a href="?page={{$menuSlug}}&tab=database" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'database' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.database') }}</a>
	<a href="?page={{$menuSlug}}&tab=settings" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'settings' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.settings') }}</a>
	<a href="?page={{$menuSlug}}&tab=tools" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'tools' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.tools') }}</a>
	<a href="?page={{$menuSlug}}&tab=table" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'table' ? 'nav-tab-active' : '' }}">{{ $funcs->_trans('messages.table') }}</a>
</h2>