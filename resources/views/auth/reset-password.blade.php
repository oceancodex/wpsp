<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ wpsp_asset('auth/main.css') }}" />
    <title>Reset password</title>
</head>

<body>
<div class="main">
    {{--    <div class="header">--}}
    {{--        <img src="/img/github-logo.svg" alt="" width="48" height="48" />--}}
    {{--    </div>--}}

    <div class="signIn">
        Register
    </div>

    <form method="POST" action="{{ wpsp_route('Apis', 'auth.reset_password', true) }}" class="form">
		<?php wpsp_nonce_field('wp_rest'); ?>
        <input type="hidden" name="token" value="{{ $token }}"/>
        <label for="email">Email address</label>
        <input type="text" name="email" id="email" tabindex="2" value="{{ $email }}" readonly/>
        <label for="password">New password</label>
        <input type="text" name="password" id="password" tabindex="3" value="{{ old('password', '') }}"/>
        <label for="password_confirmation">New password confirm</label>
        <input type="text" name="password_confirmation" id="password_confirmation" tabindex="4" value="{{ old('password_confirmation', '') }}"/>
        <input type="submit" name="commit" value="Reset password" tabindex="5" class="lastInput" style="margin-bottom: 0;"/>
    </form>
{{--    <div class="login-callout">--}}
{{--        Have an account? <a href="/auth/login">Login</a>.--}}
{{--    </div>--}}

    <div class="footer">
        <ul>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Contact OceanCodex</a></li>
        </ul>
    </div>
</div>
</body>
</html>