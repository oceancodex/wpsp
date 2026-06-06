const { readFileSync } = require('fs');
const { createServer } = require('https');
//const { createServer } = require('http');
const { Server } = require('socket.io');
const chokidar = require('chokidar');
const httpServer = createServer({
	key: readFileSync('public/node/cert-files/cert.key'),
	cert: readFileSync('public/node/cert-files/cert.crt'),
});
//const httpServer = createServer();
const io = new Server(httpServer, {
	cors: {
		origin: '*'
	},
});
io.on('connection', (socket) => {
	const watcher = chokidar.watch('.', {
		ignored: /node_modules|vendor|storage|(^|[\/\\])\../,
		persistent: true,
		awaitWriteFinish: {
			stabilityThreshold: 200,
			pollInterval: 100,
		},
//		awaitWriteFinish: true
	});
	let a = 0;
	watcher.on('change', function (path, stats) {
		// a++;
		// if (a < 2) io.sockets.emit('detectFileChanges');
		// else a = 0;
		if (stats) {
			// console.log(`File ${path} changed size to ${stats.size}`);
			io.sockets.emit('detectFileChanges');
		}
	});
	socket.on('disconnect', (socket) => {
		watcher.close().then();
	});
});
httpServer.listen(3000, () => {
	console.log('SocketIO server is running!');
});
