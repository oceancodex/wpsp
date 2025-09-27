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
        Submited value: <mark>@php echo $_POST['input_1'] ?? '...' @endphp</mark>
    </form>

    <br/>

    @if (!wpsp_auth()->check())
        <form method="POST" style="border: 1px solid red; padding: 20px;">
            <input type="hidden" name="action" value="login"/>
            <h3 style="margin-top: 0;">CUSTOM LOGIN FORM</h3>
            <p>This is custom login form using: <b>wpsp-auth</b></p>
			    <?php wpsp_nonce_field('auth_login'); ?>

            <div class="field" style="margin: 10px 0;">
                <label style="margin-bottom: 5px; display: block;">Username or Email:</label>
                <input type="text" name="login"/>
            </div>

            <div class="field" style="margin: 10px 0;">
                <label style="margin-bottom: 5px; display: block;">Password:</label>
                <input type="password" name="password"/>
            </div>

            <div class="field" style="margin: 10px 0;">
                <label><input type="checkbox" name="remember" value="1"/> Remember me</label>
            </div>

            <button type="submit">Login</button>
        </form>
    @else
        <form method="POST" style="border: 1px solid red; padding: 20px;">
            <input type="hidden" name="action" value="logout"/>
            <h3 style="margin-top: 0;">YOU ARE LOGGED IN !!!</h3>
            @php
            echo '<b>* Your data:</b><br/>';
            echo '<pre>'; print_r($user->toArray()); echo '</pre>';

            echo '<b>* Your roles:</b><br/>';
            echo '<pre>'; print_r($user->roles->toArray()); echo '</pre>';

            echo '* Your permissions:<br/>';
            echo '<pre>'; print_r($user->permissions->toArray()); echo '</pre>';

            if (wpsp_auth()->user()->can('edit_articles')) {
				echo '<hr/>';
				echo 'You can: <b>edit_articles</b> <br/><br/>';
            }
            @endphp
            <button type="submit">Logout</button>
        </form>
    @endif
@endsection