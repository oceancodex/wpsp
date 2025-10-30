<?php
switch ($checkDatabase['type'] ?? null) {
	case 'check_all_database_table_exists':
		$handleDatabaseButtonLabel = "Refresh database";
		break;
	case 'check_migration_folder_not_empty':
		$handleDatabaseButtonLabel = "Refresh database and migrations";
		break;
	case 'check_database_version_newest':
		$handleDatabaseButtonLabel = "Update database";
		break;
	default:
		$handleDatabaseButtonLabel = null;
}
?>

@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.database') }}
@endsection

{{--@section('before-wrap')--}}
{{--    ...--}}
{{--@endsection--}}

@section('content')
    <div id="poststuff">
        @isset($checkDatabase)
            @if(!$checkDatabase['result'])
                <!-- Check database result messages -->
                @if($checkDatabase['type'] == 'check_all_database_table_exists')
                    <div class="notice notice-warning inline">
                        <p>
                            Your database is missing some tables which needed to working fine!<br/>
                            You need to drop all database tables what are used for <b>{{ wpsp_config('app.name')  }}</b>.<br/>
                            Don't worry, <b>{{ wpsp_config('app.name')  }}</b> only uses its own database tables, and they need to dropped, then new database tables will be created again.<br/>
                            <span style="color: red;">Make sure you have backup yours all database tables</span> before click <b>Refresh database</b> button below!
                        </p>
                    </div>
                @elseif($checkDatabase['type'] == 'check_migration_folder_not_empty')
                    <div class="notice notice-warning inline">
                        <p>
                            Your plugin do not have any database migrations!<br/>
                            This is highly unlikely, because migrations are created and placed by the developer in each version of the plugin.<br/>
                            Maybe you intentionally deleted the database migrations, or something like that.<br/>
                            You need to delete the database tables used for this plugin then create these database tables again.<br/>
                            By clicking the <b>Refresh database and migrations</b> button below!
                        </p>
                    </div>
                @elseif($checkDatabase['type'] == 'check_database_version_newest')
                    <div class="notice notice-warning inline">
                        <p>
                            Your database version is not the newest version!<br/>
                            Please click to <b>Update database</b> button to update your database to the newest version!
                        </p>
                    </div>
                @endif

                <!-- Process messages -->
                <div id="handle_database_message" class="notice notice-info inline hidden" style="padding-top: 10px; padding-bottom: 10px;">
                    <div id="handle_database_message_inner" style="max-height: 500px; overflow: auto;"></div>
                </div>

                <!-- Alerts -->
                <div class="notice notice-info database-aditional-action-message inline hidden">
                    <p>
                        We were unable to process your database, there may have been a conflict!<br/>
                        You can try with some database handling options below:<br/>
                    </p>
                    <ol>
                        <li><b>Update database:</b> The all database tables used for this plugin will be tried to update to the newest version.</li>
                        <li><b>Refresh database:</b> Drop all database tables what are used for this plugin, then create new database tables again (maybe create new migration before if folder "migrations" is empty).</li>
                        <li><b>Refresh database and migrations:</b> Drop all database tables what are used for this plugin, then create new migration and database tables again.</li>
                        <li><b>Re-generate database and migrations:</b> Drop all database tables and all migrations what are used for this plugin, then create new migration and database tables again.</li>
                    </ol>
                    <p>
                        You should try the database handling options from left to right and <span class="text-danger"><u>make sure you have backup yours all campaigns before</u></span>.
                    </p>
                </div>

                <!-- Buttons -->
                @if($handleDatabaseButtonLabel)
                    <button class="button button-primary handle-database-button" data-type="{{ $checkDatabase['type'] }}">{{ $handleDatabaseButtonLabel }}</button>
                @endif
                <span class="database-aditional-action-buttons hidden">
				<button class="button button-secondary handle-database-button" data-type="check_all_database_table_exists">Refresh database</button>
				<button class="button button-secondary handle-database-button" data-type="check_migration_folder_not_empty">Refresh database and migrations</button>
				<button class="button button-secondary handle-database-button" data-type="regenerate_database_and_migrations">Re-generate database and migrations</button>
			</span>
            @else
                <div id="update_database_message" class="notice notice-success inline">
                    <p>Your database version is up-to-date!</p>
                </div>
            @endif
        @else
            <div id="update_database_message" class="notice notice-info inline">
                <p><b>Eloquent</b> maybe not booted, please:</p>
                <ol>
                    <li>Open terminal at the root project directory</li>
                    <li>Run command: <code>composer require oceancodex/wpsp-database</code></li>
                    <li>Go to: <b>bootstrap/app.php</b> then un-comment the line: <code>// <b><span style="color:#ff7f22;">Eloquent</span>::<span style="color:#0d6efd">init</span>();</b></code></li>
                </ol>
                <p><b>Migration</b> maybe not booted, please:</p>
                <ol>
                    <li>Open terminal at the root project directory</li>
                    <li>Run command: <code>composer require oceancodex/wpsp-migration</code></li>
                    <li>Go to: <b>bootstrap/app.php</b> then un-comment the line: <code>// <b><span style="color:#ff7f22;">Migration</span>::<span style="color:#0d6efd">init</span>();</b></code></li>
                </ol>
            </div>
        @endisset
    </div>
@endsection

{{--@section('after-wrap')--}}
{{--    <script>--}}
{{--		wpsp_localize = {--}}
{{--			"ajax_url": "{{ admin_url('admin-ajax.php') }}",--}}
{{--			"nonce": "{{ wp_create_nonce(wpsp_config('app.short_name')) }}",--}}
{{--			"public_url": "{{ Funcs::instance()->_getPublicUrl() }}"--}}
{{--		};--}}
{{--    </script>--}}
{{--    @vite('resources/ts/modules/web/admin-pages/wpsp/Database.ts')--}}
{{--@endsection--}}