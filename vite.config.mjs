import {defineConfig} from "vite";
import laravel from "laravel-vite-plugin";
import * as glob from "glob";
import path from "node:path";
import {fileURLToPath} from "node:url";

// SCSS.
let sass = Object.fromEntries(
	glob.sync("resources/scss/**/*.scss").map((file) => [
		path.relative(
			"resources/scss",
			file.slice(0, file.length - path.extname(file).length)
		),
		fileURLToPath(new URL(file, import.meta.url)),
	])
);
sass = Object.values(sass);

// CSS.
let css = Object.fromEntries(
	glob.sync("resources/css/**/*.css").map((file) => [
		path.relative(
			"resources/css",
			file.slice(0, file.length - path.extname(file).length)
		),
		fileURLToPath(new URL(file, import.meta.url)),
	])
);
css = Object.values(css);

// TS.
let ts = Object.fromEntries(
	glob.sync("resources/ts/**/*.ts").map((file) => [
		path.relative(
			"resources/ts",
			file.slice(0, file.length - path.extname(file).length)
		),
		fileURLToPath(new URL(file, import.meta.url)),
	])
);
ts = Object.values(ts);

// JS.
let js = Object.fromEntries(
	glob.sync("resources/js/**/*.js").map((file) => [
		path.relative(
			"resources/js",
			file.slice(0, file.length - path.extname(file).length)
		),
		fileURLToPath(new URL(file, import.meta.url)),
	])
);
js = Object.values(js);

let input = [sass, css, ts, js];
input = [].concat(...input);

export default defineConfig({
	resolve: {
		alias: {
			'@sass': 'resources/sass',
			'@scss': 'resources/scss',
			'@css': 'resources/css',
			'@ts': 'resources/ts',
			'@js': 'resources/js',
		}
	},

	build: {
		rollupOptions: {
			output: {
				assetFileNames: (assetInfo) => {
					// Get file extension
					// TS shows asset name can be undefined so I'll check it and create directory named `compiled` just to be safe
					let extension = assetInfo.name?.split('.').at(1) ?? 'compiled'

					// This is optional but may be useful (I use it a lot)
					// All images (png, jpg, etc) will be compiled within `images` directory,
					// all svg files within `icons` directory
					// if (/png|jpe?g|gif|tiff|bmp|ico/i.test(extension)) {
					//     extension = 'images'
					// }

					// if (/svg/i.test(extension)) {
					//     extension = 'icons'
					// }

					// Basically this is CSS output (in your case)
					return `${extension}/[name].[hash][extname]`
				},
				chunkFileNames: 'js/chunks/[name].[hash].js', // all chunks output path
				entryFileNames: 'js/[name].[hash].js' // all entrypoints output path
			}
		}
	},
	plugins: [
		laravel({
			input,
			refresh: true,
		}),
	],
});