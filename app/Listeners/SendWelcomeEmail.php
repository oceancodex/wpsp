<?php

namespace WPSP\app\Listeners;

use Carbon\Carbon;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseInstances;

class SendWelcomeEmail extends BaseInstances {

	use InstancesTrait;

	public $connection    = 'redis';
	public $queue         = 'emails';
	public $delay         = 10;
	public $tries         = 5;
	public $timeout       = 120;
	public $backoff       = [10, 30, 60];
	public $maxExceptions = 3;
	public $failOnTimeout = true;

	public function handle($event, $payload = []): void {
	}

	public function failed($event, \Throwable $exception): void {
	}

	public function middleware($event): array {
		return [
		];
	}

	public function retryUntil(): \DateTime {
		return Carbon::now()->addMinutes(10);
	}

	public function shouldQueue($event): bool {
		return true;
	}

	public function viaConnection(): string {
		return $this->connection;
	}

	public function viaQueue(): string {
		return $this->queue;
	}

	public function withDelay($event): int {
		return $this->delay;
	}

	public function backoff($event): int|array {
		return $this->backoff;
	}

}
