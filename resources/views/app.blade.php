<html>
<head>
	<title></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@vite('resources/vue/ts/app.ts', 'build/vue')
{{--	@vite('resources/vue/js/app.js', 'build/vue')--}}
	<x-inertia::head />
</head>
<body>
<x-inertia::app id="wpsp"/>
</body>
</html>