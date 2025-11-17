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
        Sign in
    </div>

    <form method="POST" action="{{ wpsp_route('Apis', 'auth.login', true) }}" class="form">
	    <?php wpsp_nonce_field('wp_rest'); ?>
        <label for="name">Username or email address</label>
        <input type="text" name="name" id="name" tabindex="1"/>
        <label for="password">Password
            <a class="label-link" href="#"> Forgot password? </a>
        </label>
        <input type="text" name="password" id="password" tabindex="1"/>
        <input type="submit" name="commit" value="Sign In" tabindex="3" class="lastInput"/>
    </form>
    <div class="login-callout">
        New user? <a href="">Create an account.</a>
    </div>

    <div class="footer">
        <ul>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Contact Github</a></li>
        </ul>
    </div>
</div>
</body>
</html>