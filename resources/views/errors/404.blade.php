<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Not found</title>

    <style>
        * {
			box-sizing: border-box;
		}

		body {
			padding: 0;
			margin: 0;
		}

		#notfound {
			position: relative;
			height: 100vh;
			background-color: #222;
		}

		#notfound .notfound {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
		}

		.notfound {
			max-width: 460px;
			width: 100%;
			text-align: center;
			line-height: 1.4;
		}

		.notfound .notfound-404 h1 {
			font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
			color: #222;
			font-size: 180px;
			letter-spacing: 10px;
			margin: 0;
			font-weight: 700;
			text-shadow: 2px 2px 0 #c9c9c9, -2px -2px 0 #c9c9c9;
		}

		.notfound .notfound-404 h1 > span {
			text-shadow: 2px 2px 0 #ffab00, -2px -2px 0 #ffab00, 0 0 8px #ff8700;
		}

		.notfound p {
			font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
			color: #c9c9c9;
			font-size: 16px;
			font-weight: 400;
			margin-top: 0;
			margin-bottom: 15px;
		}

		.notfound a {
			font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
			font-size: 14px;
			text-decoration: none;
			text-transform: uppercase;
			background: transparent;
			color: #c9c9c9;
			border: 2px solid #c9c9c9;
			display: inline-block;
			padding: 10px 25px;
			font-weight: 700;
			-webkit-transition: 0.2s all;
			transition: 0.2s all;
		}

		.notfound a:hover {
			color: #ffab00;
			border-color: #ffab00;
		}

		@media only screen and (max-width: 480px) {
			.notfound .notfound-404 h1 {
				font-size: 100px;
			}
		}</style>
    <meta name="robots" content="noindex, follow"/>
</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
        <a href="#">Home page</a>
    </div>
</div>
</body>

</html>
