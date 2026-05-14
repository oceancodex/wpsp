import { createInertiaApp } from '@inertiajs/vue3';

const appName = import.meta.env.VITE_WPSP_APP_NAME || 'WPSP Vue';

createInertiaApp({
	title   : (title) => (title ? `${title} - ${appName}` : appName),
	layout  : (name) => {
		switch (true) {
			case name === 'Welcome':
				return null;
		}
	},
	progress: {
		color: '#4B5563',
	},
}).then();