<!DOCTYPE html>
<html>
<head>

    @include('emails.default.partials.head')

    <style>

		body {
			background-color: #f4f4f4;
			width: 100% !important;
			height: 100% !important;
			margin: 0 !important;
			padding: 0 !important;
			font-family: Arial, sans-serif;
		}

		table {
			border-collapse: collapse !important;
		}

		img {
			border: 0;
			height: auto;
			line-height: 100%;
			text-decoration: none;
		}

		.wrapper {
			width: 100%;
			background-color: #f4f4f4;
		}

		.main-container {
			max-width: 600px;
			width: 100%;
		}

		/* LOGO */
		.logo-area {
			background-color: #539be2;
			text-align: center;
			padding: 40px 10px;
		}

		/* HERO */
		.hero-container {
			background-color: #539be2;
			padding: 0 10px;
		}

		.hero-inner {
			background-color: #ffffff;
			border-radius: 4px 4px 0 0;
			padding: 40px 20px 20px;
			text-align: center;
		}

		.hero-title {
			font-size: 48px;
			font-weight: 400;
			letter-spacing: 4px;
			margin: 0;
			color: #111111;
			font-family: Arial, sans-serif;
		}

		/* CONTENT */
		.content-block {
			background-color: #ffffff;
			padding: 20px 30px 40px;
			font-size: 18px;
			color: #666666;
			line-height: 25px;
			font-family: Arial, sans-serif;
		}

		/* FOOTER */
		.footer {
			color: #666666;
			font-size: 14px;
			line-height: 18px;
			font-family: Arial, sans-serif;
		}

		.footer a {
			color: #111111;
			font-weight: bold;
		}

		@media screen and (max-width:600px) {
			.hero-title {
				font-size: 32px !important;
				line-height: 32px !important;
			}
		}

    </style>
    <title></title>

</head>

<body>

<div class="wrapper">

    {{-- Logo --}}
    @include('emails.default.partials.logo')

    {{-- Hero --}}
    @include('emails.default.partials.hero', ['title' => $title ?? 'WPSP'])

    {{-- Content --}}
    <table width="100%">
        <tr>
            <td align="center" class="main-container">
                <table class="main-container">
                    <tr>
                        <td>
                            <div class="content-block">
                                @yield('content')
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Footer --}}
    @include('emails.default.partials.footer')

</div>

</body>
</html>
