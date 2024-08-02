<h2 class="nav-tab-wrapper">
	<a href="?page=<?php echo $menuSlug; ?>&tab=dashboard" class="nav-tab <?php echo !isset($requestParams['tab']) || $requestParams['tab'] == 'dashboard' ? 'nav-tab-active' : '' ?>">
        <?php echo wpsp_trans('Dashboard', true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=license" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'license' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('License key', true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=database" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'database' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Database', true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=settings" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'settings' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Settings', true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=tools" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'tools' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Tools', true) ?>
    </a>
	<a href="?page=<?php echo $menuSlug; ?>&tab=table" class="nav-tab <?php echo isset($requestParams['tab']) && $requestParams['tab'] == 'table' ? 'nav-tab-active' : '' ?>">
		<?php echo wpsp_trans('Table', true) ?>
    </a>
</h2>