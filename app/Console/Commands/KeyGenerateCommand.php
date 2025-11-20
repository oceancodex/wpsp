<?php

namespace WPSP\App\Console\Commands;

use Illuminate\Console\Command;

class KeyGenerateCommand extends \Illuminate\Foundation\Console\KeyGenerateCommand {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'key:generate
                    {--show : Display the key instead of modifying files}
                    {--force : Force the operation to run when in production}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set the application key';

	/**
	 * Write a new environment file with the given key.
	 *
	 * @param string $key
	 *
	 * @return bool
	 */
	protected function writeNewEnvironmentFileWith($key) {
		$replaced = preg_replace(
			$this->keyReplacementPattern(),
			'WPSP_APP_KEY=' . $key,
			$input = file_get_contents($this->laravel->environmentFilePath())
		);

		if ($replaced === $input || $replaced === null) {
			$this->error('Unable to set application key. No APP_KEY variable was found in the .env file.');

			return false;
		}

		file_put_contents($this->laravel->environmentFilePath(), $replaced);

		return true;
	}

	/**
	 * Get a regex pattern that will match env APP_KEY with any random key.
	 *
	 * @return string
	 */
	protected function keyReplacementPattern() {
		$escaped = preg_quote('=' . $this->laravel['config']['app.key'], '/');

		return "/^WPSP_APP_KEY{$escaped}/m";
	}

}
