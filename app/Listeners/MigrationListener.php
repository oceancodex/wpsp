<?php

namespace WPSP\app\Listeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\Migrations\Event\MigrationsEventArgs;
use Doctrine\Migrations\Event\MigrationsVersionEventArgs;
use Doctrine\Migrations\Events;

class MigrationListener implements EventSubscriber {

	public function getSubscribedEvents(): array {
		return [
			Events::onMigrationsMigrating,
			Events::onMigrationsMigrated,
			Events::onMigrationsVersionExecuting,
			Events::onMigrationsVersionExecuted,
			Events::onMigrationsVersionSkipped,
		];
	}

	public function onMigrationsMigrating(MigrationsEventArgs $args): void {
		// ...
	}

	public function onMigrationsMigrated(MigrationsEventArgs $args): void {
		// ...
	}

	public function onMigrationsVersionExecuting(MigrationsVersionEventArgs $args): void {
		// ...
	}

	public function onMigrationsVersionExecuted(MigrationsVersionEventArgs $args): void {
		// ...
	}

	public function onMigrationsVersionSkipped(MigrationsVersionEventArgs $args): void {
		// ...
	}

}