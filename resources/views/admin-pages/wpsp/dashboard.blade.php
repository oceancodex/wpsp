@extends('admin-pages.layout')

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

                    <div class="inside" style="height: 550px;">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    @php
                                        echo '<pre>'; print_r($current_wp_user->data); echo '</pre>';
										echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($wpUser); echo '</pre>';
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
                                        echo '<pre>'; print_r($current_wp_user->roles); echo '</pre>';
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
                                            echo '<pre>'; print_r($current_wp_user->allcaps); echo '</pre>';
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
                                    @if (isset($current_user) && $current_user)
                                        @php
                                            echo '<pre>'; print_r($current_user->toArray()); echo '</pre>';
                                        @endphp

                                        <form method="POST" action="{{ wpsp_route('Apis', 'auth.logout', true) }}">
                                            <input type="hidden" name="action" value="logout"/>
                                            <button type="submit" class="button">Logout</button>
                                        </form>
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <form method="POST" action="{{ wpsp_route('Apis', 'auth.login', true) }}">
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
                                                <br/>
                                                Not have account? <a href="{{ wpsp_route('RewriteFrontPages', 'auth.register', true) }}">Register</a>
                                            </div>
                                            <div class="col">
                                                <form method="POST" action="{{ wpsp_route('Apis', 'auth.forgot_password', true) }}">
                                                    <input type="hidden" name="action" value="reset-password"/>
						                                <?php wpsp_nonce_field('wp_rest'); ?>

                                                    <div class="field" style="margin-bottom: 10px;">
                                                        <label style="margin-bottom: 5px; display: block;">Email:</label>
                                                        <input type="text" name="email" value="khanhpkvn@gmail.com"/>
                                                    </div>

                                                    <button type="submit" class="button">Send reset password link</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
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
                                        if (isset($current_user)) {
											echo '<pre>'; print_r($current_user->roles ? $current_user->roles->pluck('name')->toArray() : []); echo '</pre>';
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
                                            if (isset($current_user)) {
                                                echo '<pre>'; print_r(is_array($current_user->permissions) ? $current_user->permissions : ($current_user->permissions ? $current_user->permissions->pluck('name')->toArray() : [])); echo '</pre>';
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
                                        if (isset($current_user) && $current_user instanceof \WPSPCORE\Auth\Models\DBAuthUserModel) {
//                            				$permissions = $current_user->permissions;
                                            $permissions = $current_user->roles_and_permissions;
                                        }
                                        else {
//                            			    $permissions = $current_user->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id')->pluck('name')->toArray();
                                            $permissions = [];
                                            try {
                                                $rolesWithPermissions = isset($current_user) ? $current_user->roles()->with('permissions')->get() : [];

                                                foreach ($rolesWithPermissions as $role) {
                                                    $permissions[$role->name] = $role->permissions->pluck('name')->toArray();
                                                }
                                            }
                                            catch (\Throwable $e) {
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