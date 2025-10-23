<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR: 404 - Không tìm thấy bản ghi</title>
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
			padding: 20px;
		}

		.error-container {
			background: var(--error-bg);
			border: 2px solid var(--error-color);
			border-radius: 12px;
			padding: 30px 40px;
			max-width: 600px;
			width: 90%;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			text-align: left;
			animation: fadeIn 0.5s ease;
		}

		h1 {
			color: var(--error-color);
			margin-top: 0;
			margin-bottom: 12px;
			font-size: 26px;
		}

		p.subtitle {
			margin-top: 0;
			font-weight: 500;
			color: #c9c900;
		}

		code, pre {
			background: #1e0707;
			padding: 10px;
			display: block;
			border-radius: 6px;
			overflow-x: auto;
			font-family: monospace;
		}

		ul {
			margin: 15px 0 0 20px;
			padding: 0;
		}

		li {
			margin-bottom: 8px;
			line-height: 1.5;
		}

		.back-btn {
			display: inline-block;
			margin-top: 20px;
			padding: 8px 16px;
			background: var(--error-color);
			color: white;
			border-radius: 6px;
			text-decoration: none;
			transition: background 0.2s ease;
		}

		.back-btn:hover {
			background: #b02a37;
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
    <h1>ERROR: 404 - Không tìm thấy bản ghi</h1>
    <p class="subtitle">{{ $message ?? 'Không tìm thấy bản ghi dữ liệu theo yêu cầu.' }}</p>

    <ul>
        @if(isset($model) && $model)
        <li>
            <strong>Models:</strong>
            <pre>{{ $model }}</pre>
        </li>
        @endif
    </ul>

    <a href="javascript:history.back()" class="back-btn">← Back</a>
</div>

</body>
</html>