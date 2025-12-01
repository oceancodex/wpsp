<?php

namespace WPSP\App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use WPSP\App\Models\UsersModel;

class UsersUpdatedEvent implements ShouldDispatchAfterCommit {

	use Dispatchable, InteractsWithSockets, SerializesModels;

	public UsersModel $user;

	/**
	 * Create a new event instance.
	 */
	public function __construct(UsersModel $user) {
		$this->user = $user;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return array<int, \Illuminate\Broadcasting\Channel>
	 */
	public function broadcastOn(): array {
		return [
			new PrivateChannel('channel-name'),
		];
	}

}