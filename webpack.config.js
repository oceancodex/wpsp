const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const glob = require('glob');

const entries = {};

glob.sync('./resources/views/blocks/*/index.js').forEach((file) => {
	const blockName = path.basename(path.dirname(file));
	entries[blockName] = path.resolve(__dirname, file);
});

module.exports = {
	...defaultConfig,
	entry: entries,
	output: {
		path: path.resolve(__dirname, 'resources/views/blocks/build'),
		filename: '[name]/index.js',
	},
};
