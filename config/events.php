<?php
return [
	\WPSP\app\Events\SettingsUpdatedEvent::class => [
		\WPSP\app\Listeners\SettingsUpdatedListener::class,
		\WPSP\app\Listeners\NotifyTelegramListener::class,
	],
	'users.created' => [
		\WPSP\app\Listeners\NotifyTelegramListener::class,
	]
];