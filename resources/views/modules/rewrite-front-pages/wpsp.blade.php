@extends('modules.rewrite-front-pages.layout.main')

@section('title')
    wpsp
@endsection

@section('content')
    Front page without template.
    <br/>
    <br/>
    <form method="POST" style="border: 1px solid red; padding: 20px;">
        <h3 style="margin-top: 0;">TEST SUBMIT FORM (Method: POST)</h3>
        <input type="text" name="input_1" value="Test value"/>
        <input type="submit" value="Test submit"/>
        <br/><br/>
        Submited value:
        <mark>@php echo $_POST['input_1'] ?? '...' @endphp</mark>
    </form>

    <br/>

    @if (!isset($user) || !$user)
        <form method="POST" style="border: 1px solid red; padding: 20px;" action="/wp-json/wpsp/v1/login">
            <input type="hidden" name="action" value="login"/>
            <h3 style="margin-top: 0;">CUSTOM LOGIN FORM</h3>
            <p>This is custom login form using: <b>wpsp-auth</b></p>
				<?php wpsp_nonce_field('wp_rest'); ?>

            <div class="field" style="margin: 10px 0;">
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

            <button type="submit">Login</button>
        </form>
    @else
        <form method="POST" style="border: 1px solid red; padding: 20px;" action="/wp-json/wpsp/v1/logout">
            <input type="hidden" name="action" value="logout"/>
            <h3 style="margin-top: 0;">YOU ARE LOGGED IN !!!</h3>
            @php
                try {
                    echo '<hr/><b>* Your data:</b><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">$user->toArray()</small><br/>';
                    echo '<pre>'; print_r($user ? $user->toArray() : []); echo '</pre>';

                    echo '<hr/><b>* Your roles:</b><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">$user->roles->pluck(\'name\')->toArray()</small><br/>';
					
                    if ($user->roles instanceof \WPSPCORE\Permission\Models\DBRolesModel) {
                        echo '<pre>'; print_r($user->roles->toArray()); echo '</pre>';
                    }
                    else {
                        echo '<pre>'; print_r($user->roles ? $user->roles->pluck('name')->toArray() : []); echo '</pre>';
                    }

                    echo '<hr/><b>* Your direct permissions:</b><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">$user->permissions->pluck(\'name\')->toArray()</small><br/>';
                    echo '<pre>'; print_r(is_array($user->permissions) ? $user->permissions : ($user->permissions ? $user->permissions->pluck('name')->toArray() : [])); echo '</pre>';

                    echo '<hr/>';

                    if ($user instanceof \WPSPCORE\Auth\Models\DBAuthUserModel) {
//        				$permissions = $user->permissions;
                        $permissions = $user->roles_and_permissions;
                    }
                    else {
//        			    $permissions = $user->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id')->pluck('name')->toArray();
                        $permissions = [];
						try {
                            $rolesWithPermissions = $user ? $user->roles()->with('permissions')->get() : [];

                            foreach ($rolesWithPermissions as $role) {
                                $permissions[$role->name] = $role->permissions->pluck('name')->toArray();
                            }
						}
						catch (\Exception $e) {
                            echo '<small style="color: #cc0000;">' . $e->getMessage() . '</small><br/>';
						}
                    }
                    echo '<b>* Your permissions of each role that you are assign to:</b><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">$rolesWithPermissions = $user->roles()->with(\'permissions\')->get();</small><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">foreach ($rolesWithPermissions as $role) {</small><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;padding-left:20px;">$permissions[$role->name] = $role->permissions->pluck(\'name\')->toArray();</small><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">}</small><br/>';
                    echo '<pre>'; print_r($permissions); echo '</pre>';

                    echo '<hr/>';
                    echo '<b>* Check user can do somethings:</b><br/>';
					echo '<small style="color: #cc0000;font-family: monospace;">wpsp_auth()->user()->can(\'edit_articles\')</small><br/><br/>';
					try {
                        if ($user && $user->can('edit_articles')) {
                            echo 'You can: <b>edit_articles</b> <br/><br/>';
                        }
					}
					catch (\Exception $e) {
						echo '<small style="color: #cc0000;">' . $e->getMessage() . '</small>';
					}
                }
                catch (\Exception $e) {
                    echo $e->getMessage();
                }
                echo '<hr/>';
            @endphp
            <button type="submit">Logout</button>
        </form>
    @endif
@endsection