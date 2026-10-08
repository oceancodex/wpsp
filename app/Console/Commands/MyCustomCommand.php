<?php

namespace WPSP\App\Console\Commands;

use Illuminate\Console\Command;

class MyCustomCommand extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'custom:my-custom-command';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Description of my custom command...';

	/**
	 * Execute the console command.
	 */
	public function handle() {
		// Example: ask for argument (optional)
		/*
		$argument = $this->argument('argument') ?? $this->ask(
			'Please enter the argument',
			'default-value'
		);
		*/

		// Here you put your logic
		$this->info('Custom command: "my-custom-command" executed successfully.');
	}

}