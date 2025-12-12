<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ wpsp_asset('auth/main.css') }}" />
    <title>Sign in</title>
</head>

<body>
<div class="main">
{{--    <div class="header">--}}
{{--        <img src="/img/github-logo.svg" alt="" width="48" height="48" />--}}
{{--    </div>--}}

    <div class="signIn">
        Forgot Password
    </div>

    <form method="POST" action="{{ wpsp_route('Apis', 'auth.forgot_password', true) }}" class="form">
	    <?php wpsp_nonce_field('wp_rest'); ?>
        <label for="email">Email address</label>
        <input type="text" name="email" id="email" tabindex="1" value="{{ old('email', '') }}"/>
        <input type="submit" name="commit" value="Send reset password link" tabindex="3" class="lastInput"/>
    </form>

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