import {createInertiaApp} from '@inertiajs/vue3'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
import {createApp, h} from "vue";
import './../css/app.css';

const appName = import.meta.env.VITE_WPSP_APP_NAME || 'WPSP Vue';

createInertiaApp({
	id : 'wpsp',
	title: (title) => title ? `${title} - ${appName}` : 'WPSP',
//	resolve: (name) =>
//		resolvePageComponent(
//			`./Pages/${name}.vue`,
//			import.meta.glob('./Pages/**/*.vue')
//		),
//	setup({el, App, props, plugin}) {
//		createApp({render: () => h(App, props)})
//			.use(plugin)
//			.mount(el)
//	},
}).then();