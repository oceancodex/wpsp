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
        Email verification
    </div>

    <div class="form">
        Chúng tôi đã gửi một liên kết xác thực đến địa chỉ email của bạn. Vui lòng kiểm tra email và kích hoạt tài khoản.
    </div>
    <div class="login-callout">
        Chưa nhận được email? <a href="{{ wpsp_route('RewriteFrontPages', 'verification.send', true) }}">Gửi lại</a>.
    </div>

    <div class="footer">
        <ul>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Security</a></li>
        </ul>
        <br/>
        <ul>
            <li><a href="#">OCEANCODEX</a></li>
        </ul>
    </div>
</div>
</body>
</html>