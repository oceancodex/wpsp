<?php

namespace WPSP\App\Services;

class TestService {

	public $subTestService;

	/*
	 *
	 */

	public function __construct(SubTestService $subTestService) {
		$this->subTestService = $subTestService;
	}

	/*
	 *
	 */

	public function test() {
		return 'Test service';
	}

}