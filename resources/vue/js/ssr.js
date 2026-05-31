import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createSSRApp, h } from 'vue'

const appName = import.meta.env.VITE_WPSP_APP_NAME || 'WPSP Vue'

createServer((page) =>
	createInertiaApp({
		id : 'wpsp',
		page,
		render: renderToString,

		title: (title) =>
			title
				? `${title} - ${appName}`
				: appName,

		resolve: (name) =>
			resolvePageComponent(
				`./Pages/${name}.vue`,
				import.meta.glob('./Pages/**/*.vue')
			),

		setup({ App, props, plugin }) {
			return createSSRApp({
				render: () => h(App, props),
			}).use(plugin)
		},
	})
)