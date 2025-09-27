@extends('modules.rewrite-front-pages.layout.main')

@section('title')
    wpsp
@endsection

@section('content')
    Front page without template.
    <br/>
    <br/>
    <form method="POST">
        <input type="text" name="input_1" value="Test value"/>
        <input type="submit" value="Test submit"/>
    </form>
    Submited value: <mark>@php echo $_POST['input_1'] ?? '...' @endphp</mark>



    <br/>
    <br/>


    Login
    <form method="POST">
        <input type="hidden" name="action" value="wpsp_auth_login">
	    <?php wp_nonce_field(WPSP\Funcs::nonceName('auth_login')); ?>

        <div class="field">
            <label>Username hoặc Email</label>
            <input type="text" name="login" required>
        </div>

        <div class="field">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="field">
            <label><input type="checkbox" name="remember" value="1"> Remember me</label>
        </div>

        <button type="submit">Đăng nhập</button>
    </form>
@endsection