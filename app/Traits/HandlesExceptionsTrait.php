<?php

namespace WPSP\app\Traits;

use WPSP\app\Exceptions\Handler;

trait HandlesExceptions {

	/**
	 * @var Handler
	 */
	protected $exceptionHandler;

	/**
	 * Get exception handler instance
	 *
	 * @return Handler
	 */
	protected function getExceptionHandler() {
		if (!$this->exceptionHandler) {
			$this->exceptionHandler = new Handler();
		}

		return $this->exceptionHandler;
	}

	/**
	 * Handle exception using the handler
	 *
	 * @param \Throwable $e
	 * @return mixed
	 */
	protected function handleException(\Throwable $e) {
		$handler = $this->getExceptionHandler();

		// Report the exception
		$handler->report($e);

		// Render the exception
		return $handler->render($e);
	}

}