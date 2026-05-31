/**
 * ---
 * Config for: vue-build, vue-dev
 * ---
 */

import path from "node:path";
import inertia from '@inertiajs/vite';
import {wayfinder} from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
//import {bunny} from 'laravel-vite-plugin/fonts';
import {defineConfig, loadEnv} from 'vite';

export default defineConfig(({ mode}) => {
	const env = loadEnv(mode, process.cwd(), '');
	process.env.APP_URL = env.WPSP_APP_URL_FROM_PUBLIC;

	return {
		resolve: {
			alias: {
				'@': path.resolve(__dirname, 'resources/vue/build'),
			},
		},
//		build: {
//			rollupOptions: {
//				output: {
//					assetFileNames: (assetInfo) => {
//						// Get file extension
//						// TS shows asset name can be undefined so I'll check it and create directory named `compiled` just to be safe
//						let extension = assetInfo.name?.split('.').pop() ?? 'compiled'
//
//						// This is optional but may be useful (I use it a lot)
//						// All images (png, jpg, etc) will be compiled within `images` directory,
//						// all svg files within `icons` directory
//						if (/png|jpe?g|gif|tiff|bmp|ico/i.test(extension)) {
//							extension = 'images'
//						}
//
//						if (/svg/i.test(extension)) {
//							extension = 'icons'
//						}
//
//						// Basically this is CSS output (in your case)
//						return `${extension}/[name].[hash][extname]`
//					},
//					chunkFileNames: 'js/chunks/[name].[hash].js', // all chunks output path
//					entryFileNames: 'js/[name].[hash].js' // all entrypoints output path
//				}
//			}
//		},
		plugins: [
			laravel({
				buildDirectory: 'build/vue',
				input: [
//					'resources/vue/css/app.css',
					'resources/vue/scss/app.scss',
//					'resources/vue/js/app.js',
					'resources/vue/ts/app.ts',
				],
				refresh: true,
//				fonts: [
//					bunny('Instrument Sans', {
//						weights: [400, 500, 600],
//					}),
//				],
			}),
			inertia({
				'ssr': 'resources/vue/ts/app.ts',
			}),
			tailwindcss(),
			vue({
				template: {
					transformAssetUrls: {
						base: null,
						includeAbsolute: false,
					},
				},
			}),
			wayfinder({
				formVariants: true,
				path: 'resources/vue/build',
			}),
		],
		server: {
			cors: true,
		},
	};
});