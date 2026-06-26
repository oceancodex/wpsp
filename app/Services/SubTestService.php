<?php

namespace WPSP\App\Services;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\BaseInstances;

class SubTestService extends BaseInstances {

	use InstancesTrait;

//	public function __construct() {}

	/**
	 * Trong "__wpspConstruct", tất cả params với type là Class hợp lệ\
	 * đều được sử dụng để tạo properties tự động.
	 */
	public function __wpspConstruct(
		ExampleService $exampleService
	) {}

	/*
	 *
	 */

	public function subTest() {
		return 'Sub test service';
	}

}