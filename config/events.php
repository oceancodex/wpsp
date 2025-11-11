<?php
return [
	\WPSP\App\Events\SettingsUpdatedEvent::class => [
		\WPSP\App\Listeners\SettingsUpdatedListener::class,
		\WPSP\App\Listeners\NotifyTelegramListener::class,
	],
	\WPSP\App\Events\UsersCreatedEvent::class => [
		\WPSP\App\Listeners\NotifyTelegramListener::class,
	]
];