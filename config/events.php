<?php
return [
	'settings.updated' => [
		\WPSP\app\Listeners\SettingsUpdated::class,
	],
];

//wpsp_event('settings.updated', ['id' => $id, 'changes' => $changes]);