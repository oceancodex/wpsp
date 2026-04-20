<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu</title>
    <style>
		:root {
			--error-color: #dc3545;
			--error-bg: #fff5f5;
			--text-color: #333;
			--font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
		}

		body {
			background: #f8f9fa;
			color: var(--text-color);
			font-family: var(--font-family);
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin: 0;
		}

		.error-container {
			background: var(--error-bg);
			border: 2px solid var(--error-color);
			border-radius: 12px;
			padding: 30px 40px;
			max-width: 800px;
			width: 90%;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			animation: fadeIn 0.5s ease;
			margin-top: 20px;
		}

		.error-container h1 {
			color: var(--error-color);
			margin-top: 0;
			margin-bottom: 12px;
			font-size: 26px;
			line-height: 35px;
		}

		.error-container .sub-title {
			margin-top: 0;
			font-weight: 500;
			color: #c9c900;
		}

		.error-container code, .error-container pre {
			background: #1e0707;
			padding: 10px;
			display: block;
			border-radius: 6px;
			overflow-x: auto;
			font-family: monospace;
		}

		.error-container ul {
			margin: 15px 0 0 0;
			padding: 0;
			list-style: none;
		}

		.error-container li {
			margin-bottom: 8px;
			line-height: 1.5;
			list-style: none;
		}

		.error-container .back-btn {
			display: inline-block;
			margin-top: 10px;
			padding: 8px 16px;
			background: var(--error-color);
			color: white;
			border-radius: 6px;
			text-decoration: none;
			transition: background 0.2s ease;
		}

		.error-container .back-btn:hover {
			background: #b02a37;
		}

		.error-container hr {
			border: none;
			border-top: 1px dashed #555;
		}

		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(10px); }
			to { opacity: 1; transform: translateY(0); }
		}

		/* Dark mode friendly */
		@media (prefers-color-scheme: dark) {
			:root {
				--error-bg: #2b1a1a;
				--text-color: #f1f1f1;
			}
			body { background: #121212; }
		}
    </style>
</head>
<body>

<div class="error-container">
    <h1>ERROR: 500 - Lỗi truy vấn cơ sở dữ liệu</h1>
    <p class="sub-title">Ứng dụng đang ở chế độ debug, hiển thị thông tin truy vấn chi tiết.</p>

	<hr/>

    <ul>
        @if(!empty($type))
        <li>
            <strong>Type:</strong>
            <pre>{{ $type }}</pre>
        </li>
        @endif

        @if(!empty($message))
        <li>
            <strong>Message:</strong>
            <pre>{{ $message }}</pre>
        </li>
        @endif

        @if(!empty($error))
        <li>
            <strong>Error:</strong>
            <pre>{{ print_r($error, true) }}</pre>
        </li>
        @endif

        @if(!empty($sql))
        <li>
            <strong>SQL Query:</strong>
            <pre>{{ $sql }}</pre>
        </li>
        @endif

        @if(!empty($bindings))
        <li>
            <strong>Bindings:</strong>
            <pre>{{ print_r($bindings, true) }}</pre>
        </li>
        @endif
    </ul>

    <a href="javascript:history.back()" class="back-btn">← Quay lại</a>
</div>

</body>
</html>