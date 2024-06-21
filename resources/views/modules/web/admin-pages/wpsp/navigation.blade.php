<h2 class="nav-tab-wrapper">
	<a href="?page={{$menuSlug}}" class="nav-tab {{ !isset($requestParams['tab']) || $requestParams['tab'] == 'dashboard' ? 'nav-tab-active' : '' }}">{{ trans('messages.dashboard') }}</a>
	<a href="?page={{$menuSlug}}&tab=license" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'license' ? 'nav-tab-active' : '' }}">{{ trans('messages.license_key') }}</a>
	<a href="?page={{$menuSlug}}&tab=database" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'database' ? 'nav-tab-active' : '' }}">{{ trans('messages.database') }}</a>
	<a href="?page={{$menuSlug}}&tab=settings" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'settings' ? 'nav-tab-active' : '' }}">{{ trans('messages.settings') }}</a>
	<a href="?page={{$menuSlug}}&tab=tools" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'tools' ? 'nav-tab-active' : '' }}">{{ trans('messages.tools') }}</a>
</h2>