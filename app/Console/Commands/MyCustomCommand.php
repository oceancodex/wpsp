<?php

namespace WPSP\app\Console\Commands;

use WPSPCORE\Traits\CommandsTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyCustomCommand extends Command {

	use CommandsTrait;

	protected function configure(): void {
		$this
			->setName('custom:my-custom-command')
			->setDescription('Description of my custom command...')
			->setHelp('Help for my custom command...')
			/*->addArgument('argument', InputArgument::OPTIONAL, 'An argument description...')
			->addOption('option', null, InputOption::VALUE_NONE, 'An option description...')*/;
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
//		$argument = $input->getArgument('argument');

		// If argument is empty.
//		$helper = $this->getHelper('question');
//		if (!$argument) {
//			$argumentQuestion = new Question('Please enter the argument: ', 'custom-command');
//			$argument         = $helper->ask($input, $output, $argumentQuestion);
//
//			if (empty($argument)) {
//				$output->writeln('Missing "argument". Please try again.');
//				return Command::INVALID;
//			}
//		}

		// Define variables.
//		$argumentSlugify = Str::slug($argument, '_');

		// Maybe your code goes here...

		// Output message.
		$output->writeln('Custom command: "my-custom-command" executed successfully.');

		// this method must return an integer number with the "exit status code"
		// of the command. You can also use these constants to make code more readable

		// return this if there was no problem running the command
		// (it's equivalent to returning int(0))
		return Command::SUCCESS;

		// or return this if some error happened during the execution
		// (it's equivalent to returning int(1))
//		return Command::FAILURE;

		// or return this to indicate incorrect command usage; e.g. invalid options
		// or missing arguments (it's equivalent to returning int(2))
//		return Command::INVALID
	}

}