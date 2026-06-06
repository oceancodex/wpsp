jQuery(function($) {
	let ip_address = 'wordpress.local';
	let socket_port = '3000';
	let socket = io(ip_address + ':' + socket_port);
//	let socket = io('http://' + ip_address + ':' + socket_port);
	socket.on('detectFileChanges', (message) => {
		window.location.reload();
	});
});
