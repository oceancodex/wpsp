@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('Users', true) }}
@endsection

@section('after-title')
    <a href="?page={{$menuSlug}}&tab=users&action=create" class="page-title-action">{{ wpsp_trans('Add new', true) }}</a>
@endsection

@section('content')
    @if($current_request->get('action') == 'show' && $current_request->get('id'))
        <div id="poststuff">
            <div class="actions mt-2 mb-3">
                <a class="button" href="?page={{$menuSlug}}&tab=users">Back</a>
            </div>
            <div  class="row gx-3">
                <div class="col">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.information') }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @php
                                                echo '<pre>'; print_r($selected_user->toArray()); echo '</pre>';
                                            @endphp
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.roles') }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @php
                                                echo '<pre>'; print_r($selected_user->roles->pluck('name')->toArray()); echo '</pre>';
                                            @endphp
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.permissions') }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @php
                                                $permissions = [];
                                                try {
                                                    $rolesWithPermissions = $selected_user ? $selected_user->roles()->with('permissions')->get() : [];

                                                    foreach ($rolesWithPermissions as $role) {
                                                        $permissions[$role->name] = $role->permissions->pluck('name')->toArray();
                                                    }
                                                }
                                                catch (\Throwable $e) {}
                                                echo '<pre>'; print_r($permissions); echo '</pre>';
                                            @endphp
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif($current_request->get('action') == 'create')
        <form method="POST">
            <input name="action" value="create_user" type="hidden"/>
            <div id="poststuff" class="row gx-2">
                <div class="col">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('Add new user', true) }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside form-table w-auto">

                                <div class="input-group mt-2 mb-3">
                                    <label for="name">
                                        {{ wpsp_trans('Name', true) }}:
                                        <input type="text" id="name" name="name" class="w-100 mt-1" value="{{ $_POST['name'] ?? 'name_' . time() }}"/>
                                    </label>
                                </div>

                                <div class="input-group mt-2 mb-3">
                                    <label for="email">
                                        {{ wpsp_trans('Email', true) }}:
                                        <input type="text" id="email" name="email" class="w-100 mt-1" value="{{ $_POST['email'] ?? 'email_' . time() . '@example.com' }}"/>
                                    </label>
                                </div>

                                <div class="input-group mt-2">
                                    <label for="password">
                                        {{ wpsp_trans('Password', true) }}:
                                        <input type="text" id="password" name="password" class="w-100 mt-1" value="{{ $_POST['password'] ?? '123456' }}"/>
                                    </label>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="button button-primary">{{ wpsp_trans('Add new', true) }}</button>
                    </div>
                </div>
            </div>
        </form>

    @elseif($current_request->get('action') == 'edit')
        <form method="POST">
            <input name="action" value="create_user" type="hidden"/>
            <div id="poststuff" class="row gx-2">
                <div class="col">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('Edit user', true) }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside form-table w-auto">

                                <div class="input-group mt-2 mb-3">
                                    <label for="name">
                                        {{ wpsp_trans('Name', true) }}:
                                        <input type="text" id="name" name="name" class="w-100 mt-1" value="{{ $_POST['name'] ?? $selected_user->name ?? '' }}"/>
                                    </label>
                                </div>

                                <div class="input-group mt-2">
                                    <label for="email">
                                        {{ wpsp_trans('Email', true) }}:
                                        <input type="text" id="email" name="email" class="w-100 mt-1" value="{{ $_POST['email'] ?? $selected_user->email ?? '' }}"/>
                                    </label>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="button button-primary">{{ wpsp_trans('Update', true) }}</button>
                    </div>
                </div>
            </div>
        </form>

    @else
        <form method="GET">
            <input type="hidden" name="page" value="{{ $_REQUEST['page'] ?? '' }}"/>
            <input type="hidden" name="tab" value="{{ $_REQUEST['tab'] ?? '' }}"/>
            @php
                $table->prepare_items();
                $table->views();
                $table->search_box('Search', 'search_id');
                $table->display();
            @endphp
        </form>
    @endif
@endsection