@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('Dashboard', true) }}
@endsection

@section('content')
    <h2 style="color: blue;">Người dùng hiện tại xác thực qua WordPress</h2>
    <div id="poststuff" class="row gx-3">
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

                    <div class="inside" style="height: 488px;">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    @php
                                        echo '<pre>'; print_r($wp_user->data); echo '</pre>';
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
                                        echo '<pre>'; print_r($wp_user->roles); echo '</pre>';
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
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            echo '<pre>'; print_r($wp_user->allcaps); echo '</pre>';
                                        @endphp
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <h2 style="color: red;">Người dùng hiện tại xác thực qua "wpsp-auth"</h2>
    <div id="poststuff" class="row gx-3">
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

                    <div class="inside" style="height: 668.5px;">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    @if (isset($user) && $user)
                                        @php
                                            echo '<pre>'; print_r($user->toArray()); echo '</pre>';
                                        @endphp

                                        <form method="POST" action="/wp-json/wpsp/v1/logout">
                                            <input type="hidden" name="action" value="logout"/>
                                            <button type="submit" class="button">Logout</button>
                                        </form>
                                    @else
                                        <form method="POST" action="/wp-json/wpsp/v1/login">
                                            <input type="hidden" name="action" value="login"/>
												<?php wpsp_nonce_field('wp_rest'); ?>

                                            <div class="field">
                                                <label style="margin-bottom: 5px; display: block;">Username or Email:</label>
                                                <input type="text" name="login" value="admin"/>
                                            </div>

                                            <div class="field" style="margin: 10px 0;">
                                                <label style="margin-bottom: 5px; display: block;">Password:</label>
                                                <input type="text" name="password" value="123@123##"/>
                                            </div>

                                            <div class="field" style="margin: 10px 0;">
                                                <label><input type="checkbox" name="remember" value="1"/> Remember me</label>
                                            </div>

                                            <button type="submit" class="button">Login</button>
                                        </form>
                                    @endcan
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
                                        if (isset($user)) {
											if ($user->roles instanceof \WPSPCORE\Permission\Models\DBRolesModel) {
                                                echo '<pre>'; print_r($user->roles->toArray()); echo '</pre>';
                                            }
                                            else {
                                                echo '<pre>'; print_r($user->roles ? $user->roles->pluck('name')->toArray() : []); echo '</pre>';
                                            }
                                        }
                                        else {
                                            echo '<pre>'; print_r([]); echo '</pre>';
                                        }
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
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            if (isset($user)) {
                                                echo '<pre>'; print_r(is_array($user->permissions) ? $user->permissions : ($user->permissions ? $user->permissions->pluck('name')->toArray() : [])); echo '</pre>';
                                            }
											else {
												echo '<pre>'; print_r([]); echo '</pre>';
											}
                                        @endphp
                                    </div>
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
                        <h2 class="hndle ui-sortable-handle">Permissions of each role</h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="toggle-indicator"></span>
                            </button>
                        </div>
                    </div>

                    <div class="inside">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        @php
                                        if (isset($user) && $user instanceof \WPSPCORE\Auth\Models\DBAuthUserModel) {
//                            				$permissions = $user->permissions;
                                            $permissions = $user->roles_and_permissions;
                                        }
                                        else {
//                            			    $permissions = $user->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id')->pluck('name')->toArray();
                                            $permissions = [];
                                            try {
                                                $rolesWithPermissions = isset($user) ? $user->roles()->with('permissions')->get() : [];

                                                foreach ($rolesWithPermissions as $role) {
                                                    $permissions[$role->name] = $role->permissions->pluck('name')->toArray();
                                                }
                                            }
                                            catch (\Exception $e) {
                                                echo '<small style="color: #cc0000;">' . $e->getMessage() . '</small><br/>';
                                            }
                                        }
										echo '<pre>'; print_r($permissions); echo '</pre>';
                                        @endphp
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection