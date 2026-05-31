import {createInertiaApp} from '@inertiajs/vue3';
import {createApp, h} from 'vue';
import './../css/app.css';

const appName = import.meta.env.VITE_WPSP_APP_NAME || 'WPSP Vue';

createInertiaApp({
	id     : 'wpsp',
	title  : (title) => (title ? `${title} - ${appName}` : 'WPSP'),
	layout : (name) => {
		switch (true) {
			case name === 'Welcome':
				return null;
		}
	},
	resolve: (name) => {
		return import.meta.glob('/resources/vue/pages/**/*.vue', { eager: true })[`/resources/vue/pages/${name}.vue`];
	},
	setup({el, App, props, plugin}) {
		createApp({render: () => h(App, props)})
			.use(plugin)
			.mount(el);
	},
	progress: {
		color: '#4B5563'
	},
}).then();