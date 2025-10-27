<?php

namespace WPSP\app\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use WPSP\app\Extras\Instances\Routes\MapRoutes;
use WPSP\Funcs;
use WPSPCORE\FileSystem\FileSystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use WPSPCORE\Console\Traits\CommandsTrait;

class RouteRemapCommand extends Command {

	use CommandsTrait;

	protected function configure() {
		$this
			->setName('route:remap')
			->setDescription('Remap routes.                   | Eg: bin/wpsp route:remap')
			->setHelp('This command is used to remap routes...')
			->addOption('ide', null, InputOption::VALUE_OPTIONAL, 'Choose IDE to auto-reload. Supported: phpstorm');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		require Funcs::instance()->_getSitePath('/wp-config.php');

		$routeMap = MapRoutes::instance()->mapIdea;

		if (empty($routeMap)) {
			$output->writeln('<error>No routes found!</error>');
			$output->writeln('<info>You must make sure that your Database Server is running.</info>');
			return Command::INVALID;
		}

		$pluginDirName = $this->funcs->_getPluginDirName();

		$prepareMap           = [];
		$prepareMap['scope']  = $pluginDirName;
		$prepareMap['routes'] = $routeMap;
		$prepareMap           = json_encode($prepareMap, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//		$prepareMap = json_encode($prepareMap, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

		// Write file.
		FileSystem::put($this->mainPath . '/.wpsp-routes.json', $prepareMap);

		// Handle IDE auto-reload
		$ide = strtolower($input->getOption('ide') ?? null);
		if ($ide === 'phpstorm') {
			$this->writeln($output, '[IDE] Auto reload triggered for PHPStorm');
			$psScript = Funcs::instance()->mainPath . '/bin/phpstorm-auto-reload.ps1';
			exec('pwsh ' . escapeshellarg($psScript));
		}

		// Output message.
		$this->writeln($output, '<green>Remap routes successfully!</green>');

		// this method must return an integer number with the "exit status code"
		// of the command. You can also use these constants to make code more readable

		// return this if there was no problem running the command
		// (it's equivalent to returning int(0))
		return Command::SUCCESS;

		// or return this if some error happened during the execution
		// (it's equivalent to returning int(1))
//		 return Command::FAILURE;

		// or return this to indicate incorrect command usage; e.g. invalid options
		// or missing arguments (it's equivalent to returning int(2))
		// return Command::INVALID
	}

}