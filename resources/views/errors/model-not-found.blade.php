<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy</title>
    <style>
		body {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
			background: #f5f5f5;
			margin: 0;
			padding: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
		}
		.error-container {
			background: white;
			padding: 40px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			text-align: center;
		}
		h1 {
			color: #d63638;
			font-size: 72px;
			margin: 0;
		}
		h2 {
			color: #333;
			font-size: 24px;
			margin: 20px 0;
		}
		p {
			color: #666;
			line-height: 1.6;
		}
		.back-link {
			display: inline-block;
			margin-top: 20px;
			padding: 10px 20px;
			background: #2271b1;
			color: white;
			text-decoration: none;
			border-radius: 4px;
		}
		.back-link:hover {
			background: #135e96;
		}
		.model-info {
			background: #f0f0f1;
			padding: 10px;
			border-radius: 4px;
			margin: 15px 0;
			font-family: monospace;
		}
    </style>
</head>
<body>
<div class="error-container">
    <h1>404</h1>
    <h2>Model not found</h2>
    <p>{{ $message ?? 'Không tìm thấy bản ghi theo yêu cầu.' }}</p>

    @if(isset($model) && $model)
        <div class="model-info">
            Model: <strong>{{ $model }}</strong>
        </div>
    @endif

    <a href="javascript:history.back()" class="back-link">← Back</a>
</div>
</body>
</html>