<?php

namespace WPSP\App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use WPSP\App\Models\SettingsModel;

class SettingsUpdatedEvent implements ShouldBroadcast, ShouldDispatchAfterCommit {

	use Dispatchable, InteractsWithSockets, SerializesModels;

	// Dữ liệu public sẽ tự động được gửi qua WebSocket tới client
	public $settings;

	/**
	 * Create a new event instance.
	 */
	public function __construct(SettingsModel $settings) {
		$this->settings = $settings;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return array<int, \Illuminate\Broadcasting\Channel>
	 */
	public function broadcastOn() {
		return [
			new PrivateChannel('settings'),
		];
	}

	/**
	 * (Tùy chọn) Tùy chỉnh tên Event bắn về phía JS. Mặc định sẽ là "SettingsUpdatedEvent"
	 */
	public function broadcastAs(): string {
		return 'settings.updated';
	}

}