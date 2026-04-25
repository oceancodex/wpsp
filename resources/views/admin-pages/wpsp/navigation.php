<div class="nav-tab-wrapper">
	<a href="?page=<?php echo $menuSlug; ?>&tab=dashboard" class="nav-tab <?php echo !isset($requestParams['tab']) || $requestParams['tab'] == 'dashboard' ? 'nav-tab-active' : '' ?>">
        <?php echo wpsp_trans('Dashboard', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=license" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'license' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('License key', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=database" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'database' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Database', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=settings" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'settings' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Settings', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=tools" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'tools' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Tools', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=table" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'table' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Table', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=roles" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'roles' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Roles', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=permissions" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'permissions' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Permissions', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=users" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'users' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Users', null, true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=activity_log" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'activity_log' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Activity log', null, true) ?>
    </a>
</div>