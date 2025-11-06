<?php

namespace WPSP\app\Listeners;

class LogWrittenListener {

	public function handle($event, $payload = []) {
		// $event = 'logging.written'
		// $payload: channel, level, message, context, time
		// Ví dụ: gửi Telegram, Slack, hoặc ghi thêm audit...
		// ...
		error_log('123');
		return null;
	}

}