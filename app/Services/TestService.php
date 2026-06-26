<?php

namespace WPSP\App\Services;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\BaseInstances;

class TestService extends BaseInstances {

	use InstancesTrait;

	/*
	 *
	 */

//	public function __construct(SubTestService $subTestService) {
//		$this->subTestService = $subTestService;
//	}

	/**
	 * Trong "__wpspConstruct", tất cả params với type là Class hợp lệ\
	 * đều được sử dụng để tạo properties tự động.
	 */
	public function __wpspConstruct(
		SubTestService $subTestService
	) {}

	/*
	 *
	 */

	public function test() {
		return 'Test service';
	}

}