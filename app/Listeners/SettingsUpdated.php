<?php
namespace WPSP\app\Listeners;

use WPSPCORE\Events\Contracts\ListenerContract;

class SettingsUpdated implements ListenerContract {
	public function handle(string $event, array $payload = []): void {
		// Xử lý khi setting cập nhật
	}
}