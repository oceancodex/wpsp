const mix = require('laravel-mix');
const fs = require('fs');
const glob = require('glob');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');

mix.disableNotifications();

glob.sync('resources/css/**/*.css').forEach(file => {
	let filePath = `public/css/${file.replace(`resources\\css\\`, '').replace('.css', '.min.css')}`;
	mix.css(file, filePath).options({
		processCssUrls: false
	});
});

glob.sync('resources/scss/**/*.scss').forEach(file => {
    let filePath = `public/scss/${file.replace(`resources\\scss\\`, '').replace('.scss', '.min.css')}`;
    mix.sass(file, filePath).options({
        processCssUrls: false
    });
});

glob.sync('resources/ts/**/*.ts').filter(file => !file.endsWith('.d.ts')).forEach(file => {
    let filePath = `public/ts/${file.replace(`resources\\ts\\`, '').replace('.ts', '.min.js')}`;
    mix.ts(file, filePath)
        .webpackConfig({
            module:  {
                rules: [
                    {
                        test:    /\.tsx?$/,
                        loader:  'ts-loader',
                        exclude: /node_modules/,
                    },
                ],
            },
            resolve: {
                extensions: [".*", ".wasm", ".mjs", ".js", ".jsx", ".json", ".ts", ".tsx", ".vue"],
            },
        });
});

glob.sync('resources/js/**/*.js').forEach(file => {
	let filePath = `public/js/${file.replace(/^resources[\\/]+js[\\/]+/, "").replace(".js", ".min.js")}`;
    mix.js(file, filePath);
});