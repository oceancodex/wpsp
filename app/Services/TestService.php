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

	public function __wpspConstruct(
		SubTestService $subTestService
	) {}

	/*
	 *
	 */

	public function test() {
//		return $subTestService->subTest();
		return $this->subTestService->subTest();
//		return 'Test service';
	}

}