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

    <div class="form">
        <label for="login">Username or email address</label>
        <input type="text" name="login" id="login" tabindex="1"/>
        <label for="password">Password
            <a class="label-link" href="#"> Forgot password? </a>
        </label>
        <input type="text" name="password" id="password" tabindex="1"/>
        <input type="submit" name="commit" value="Sign In" tabindex="3" class="lastInput"/>
    </div>
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