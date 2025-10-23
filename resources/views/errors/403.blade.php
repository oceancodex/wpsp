<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR: 403 - Truy cập bị từ chối</title>
    <meta name="description" content="403 Forbidden — Bạn không có quyền truy cập vào tài nguyên này.">

    <style>
        :root { --bg: #0f1724; --card: #0b1220; --accent: #ff6b6b; --muted: rgba(255, 255, 255, 0.65); --glass: rgba(255, 255, 255, 0.04); --radius: 14px; font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; } * { box-sizing: border-box } html, body { height: 100% } body { margin: 0; background: linear-gradient(180deg, #061024 0%, #081428 60%); color: #fff; display: flex; align-items: center; justify-content: center; padding: 24px; } .card { width: 100%; max-width: 900px; background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01)); border-radius: var(--radius); padding: 32px; box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.02); display: grid; grid-template-columns: 1fr 420px; gap: 28px; align-items: center; } @media (max-width: 880px) { .card { grid-template-columns:1fr; padding: 22px } } .code-badge { display: inline-flex; align-items: center; gap: 10px; font-size: 30px; padding: 10px 20px; background: var(--glass); border-radius: 14px; font-weight: 600; color: var(--accent); width: max-content; } h1 { margin: 16px 0 25px 0; font-size: 42px; line-height: 1; letter-spacing: -0.02em; } p.lead { margin: 0 0 20px 0; color: var(--muted); font-size: 16px } .actions { display: flex; gap: 12px; flex-wrap: wrap } .btn { display: inline-flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; font-weight: 600; text-decoration: none; background: transparent; border: 1px solid rgba(255, 255, 255, 0.1); color: inherit; transition: transform .12s ease, box-shadow .12s ease; } .btn:active { transform: translateY(1px) } .btn-primary { background: linear-gradient(90deg, var(--accent), #ff8b8b); color: #0b1017; border: 0 } .btn-ghost { background: transparent } .meta { color: var(--muted); font-size: 13px; margin-top: 20px } .ill { display: flex; align-items: center; justify-content: center; padding: 18px; border-radius: 12px; background: radial-gradient(circle at 20% 10%, rgba(255, 107, 107, 0.06), transparent 20%), rgba(255, 255, 255, 0.01); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02); } .svg-wrap { max-width: 320px; width: 100% } footer.small { margin-top: 18px; color: rgba(255, 255, 255, 0.4); font-size: 12px } .hint { margin-top: 14px; background: rgba(255, 255, 255, 0.02); padding: 10px 12px; border-radius: 8px; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", monospace; font-size: 13px }
    </style>
</head>
<body>
<main class="card" role="main" aria-labelledby="title">
    <section>
        <div class="code-badge">ERROR: 403</div>

        <h1 id="title">Truy cập bị từ chối</h1>
        <p class="lead">{{ $message ?? 'Bạn không có quyền truy cập vào trang này hoặc tài nguyên đã bị giới hạn bởi máy chủ.' }}</p>

        <div class="actions">
            <a class="btn btn-primary" href="/">Quay về trang chủ</a>
            <a class="btn btn-ghost" href="javascript:history.back()">Quay lại trang trước</a>
        </div>

        <div class="meta">Nếu bạn cho rằng đây là lỗi, vui lòng kiểm tra quyền truy cập hoặc liên hệ quản trị viên.</div>

        <footer class="small">Mã lỗi: <strong>403 — Forbidden</strong> · Thời gian: <span id="ts">--:--</span></footer>
    </section>

    <aside class="ill" aria-hidden="true">
        <div class="svg-wrap">
            <svg viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Lock illustration">
                <defs>
                    <linearGradient id="g1" x1="0" x2="1">
                        <stop offset="0%" stop-color="#ff8b8b" stop-opacity="0.9"/>
                        <stop offset="100%" stop-color="#ff6b6b" stop-opacity="0.9"/>
                    </linearGradient>
                </defs>
                <rect width="600" height="400" rx="18" fill="url(#g1)" opacity="0.06"/>
                <g transform="translate(110,70)">
                    <rect y="120" width="380" height="200" rx="18" fill="#071229" opacity="0.95"/>
                    <g transform="translate(120,26)">
                        <rect y="60" width="140" height="120" rx="10" fill="#0b1220" stroke="rgba(255,255,255,0.03)"/>
                        <path d="M70 38c24 0 44 19 44 44v12" stroke="#26425a" stroke-width="8" fill="none" stroke-linecap="round"/>
                        <circle cx="70" cy="110" r="14" fill="#122535"/>
                        <rect x="64" y="100" width="12" height="20" rx="2" fill="#ffdfdf"/>
                        <text y="-8" x="-17" fill="#9fc9d9" font-size="24" font-family="sans-serif">403 - Forbidden</text>
                    </g>
                </g>
            </svg>
        </div>
    </aside>
</main>

<script>
	(function () {
		const el       = document.getElementById('ts');
		el.textContent = new Date().toLocaleString();
	})();
</script>
</body>
</html>
