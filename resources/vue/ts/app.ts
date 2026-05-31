import {createInertiaApp} from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent} from 'vue';
import {createSSRApp} from 'vue';
import {createApp, h} from 'vue';

const appName = import.meta.env.VITE_WPSP_APP_NAME || 'WPSP Vue';

createInertiaApp({
	id: 'wpsp',
	resolve: async (name): Promise<DefineComponent> => {
		return await resolvePageComponent(
			`/resources/vue/pages/${name}.vue`,
			import.meta.glob('/resources/vue/pages/**/*.vue'),
		) as DefineComponent;
	},
	// setup({ el, App, props, plugin }) {
	// 	createApp({ render: () => h(App, props) })
	// 		.use(plugin)
	// 		.mount(el);
	// 	// createSSRApp({ render: () => h(App, props) })
	// 	// 	.use(plugin)
	// 	// 	.mount(el);
	// },
	title: (title) => (title ? `${title} - ${appName}` : appName),
	layout  : (name) => {
		switch (true) {
			case name === 'Welcome':
				return null;
		}
	},
	progress: {
		color: '#4B5563'
	},
}).then();