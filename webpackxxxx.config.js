const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const glob = require('glob');

const blocksDir = path.resolve(__dirname, 'resources/blocks');
const buildDir  = path.resolve(__dirname, 'resources/blocks/.build');

const entries = {};

// Lấy index.js của từng block
glob.sync(`${blocksDir}/*/index.js`).forEach((file) => {
	const blockName = path.basename(path.dirname(file));
	entries[blockName] = path.resolve(__dirname, file);
});

module.exports = {
	...defaultConfig,

	entry: entries,

	output: {
		path: buildDir,
		filename: '[name]/index.js'
	},

	resolve: {
		...defaultConfig.resolve
	}
};
