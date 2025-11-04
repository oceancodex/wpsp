<?php

namespace WPSP\app\Workers\Queue;

use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Workers\Container\Container;
use WPSP\Funcs;

class Queue extends \WPSPCORE\Queue\Queue {

	use InstancesTrait;

	public static $instance = null;

	public static function instance($init = false) {
		if ($init && !static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'     => Funcs::instance(),
					'container' => Container::instance(),
				]
			);
		}
		return static::$instance;
	}

	public static function init() {
		return static::instance(true);
	}

	/**
	 * Tạo và dispatch batch jobs
	 *
	 * Ví dụ:
	 * $batch = Queue::batch([
	 *     new MyJob(),
	 *     new AnotherJob(),
	 * ]);
	 *
	 * // Với callbacks:
	 * Queue::batch([
	 *     new MyJob(),
	 *     new AnotherJob(),
	 * ])->then(function(\Illuminate\Bus\Batch $batch) {
	 *     // Tất cả thành công
	 * })->catch(function(\Illuminate\Bus\Batch $batch, \Throwable $e) {
	 *     // Có job thất bại
	 * })->finally(function(\Illuminate\Bus\Batch $batch) {
	 *     // Luôn chạy
	 * });
	 *
	 * @param array       $jobs Mảng jobs
	 * @param string|null $name Tên batch (tùy chọn)
	 *
	 * @return \Illuminate\Bus\PendingBatch
	 */
	public static function batch(array $jobs, ?string $name = null) {
		$container = static::instance()->getContainer();

		if (!$container) {
			throw new \RuntimeException('Queue container not initialized');
		}

		// Lấy Bus dispatcher từ container
		$busDispatcher = $container->make(\Illuminate\Contracts\Bus\Dispatcher::class);

		if (!$busDispatcher) {
			throw new \RuntimeException('Bus dispatcher not found in container');
		}

		// Tạo PendingBatch
		$pendingBatch = $busDispatcher->batch($jobs);

		// Dispatch nó - cách khác là sử dụng helper dispatch_batch
		// return $pendingBatch->then(fn() => null)->dispatch();

		// Cách đơn giản: push từng job vào queue
		\WPSPCORE\Queue\Logger::info('Batching ' . count($jobs) . ' jobs');

		foreach ($jobs as $job) {
			if (method_exists($job, 'dispatch')) {
				$job->dispatch();
			}
			else {
				static::instance()->push($job);
			}
		}

		// Trả về batch object
		return $pendingBatch->dispatch();
	}

}