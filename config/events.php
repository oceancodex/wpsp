<?php
return [
	\WPSP\app\Events\SettingsUpdatedEvent::class => [
		\WPSP\app\Listeners\SettingsUpdatedListener::class,
		\WPSP\app\Listeners\NotifyTelegramListener::class,
	],
	\WPSP\app\Events\UsersCreatedEvent::class => [
		\WPSP\app\Listeners\NotifyTelegramListener::class,
	]
];