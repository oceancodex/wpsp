<?php

namespace WPSP\app\Listeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\Migrations\Event\MigrationsEventArgs;
use Doctrine\Migrations\Event\MigrationsVersionEventArgs;
use Doctrine\Migrations\Events;

class MigrationListener implements EventSubscriber {

	public function getSubscribedEvents() {
		return [
			Events::onMigrationsMigrating,
			Events::onMigrationsMigrated,
			Events::onMigrationsVersionExecuting,
			Events::onMigrationsVersionExecuted,
			Events::onMigrationsVersionSkipped,
		];
	}

	public function onMigrationsMigrating(MigrationsEventArgs $args) {
		// ...
	}

	public function onMigrationsMigrated(MigrationsEventArgs $args) {
		// ...
	}

	public function onMigrationsVersionExecuting(MigrationsVersionEventArgs $args) {
		// ...
	}

	public function onMigrationsVersionExecuted(MigrationsVersionEventArgs $args) {
		// ...
	}

	public function onMigrationsVersionSkipped(MigrationsVersionEventArgs $args) {
		// ...
	}

}