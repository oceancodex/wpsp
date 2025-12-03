<?php

namespace WPSP\App\Instances\Queue;

use WPSP\App\Instances\Container\Container;
use WPSP\App\Instances\InstancesTrait;
use WPSP\Funcs;

class Queue extends \WPSPCORE\Queue\Queue {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-queue')) {
			return static::instance(true);
		}
		return null;
	}

	/**
	 * @param $init
	 *
	 * @return null|static
	 */
	public static function instance($init = false) {
		if ($init && !static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			);
		}
		return static::$instance;
	}

	/*
	 *
	 */

	/**
	 * Tạo PendingBatch để caller tự quyết định then/catch/finally và dispatch.
	 *
	 * @param array       $jobs
	 * @param string|null $name
	 *
	 * @return \Illuminate\Bus\PendingBatch
	 */
	public static function batch(array $jobs, string $name = null) {
		$container = static::instance()->getContainer();
		if (!$container) {
			throw new \RuntimeException('Queue container not initialized');
		}

		// Lấy Bus dispatcher
		$busDispatcher = $container->make(\Illuminate\Contracts\Bus\Dispatcher::class);
		if (!$busDispatcher) {
			throw new \RuntimeException('Bus dispatcher not found in container');
		}

		$pending = $busDispatcher->batch($jobs);

		// Không ép connection/queue ở đây; để config quyết định
		if ($name) {
			$pending->name($name);
		}

		return $pending;
	}

}