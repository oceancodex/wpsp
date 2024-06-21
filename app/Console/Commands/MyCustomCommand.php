<?php

namespace App\Console\Commands;

use OCBPCORE\Objects\File\FileHandler;
use OCBPCORE\Objects\Slugify\Slugify;
use OCBPCORE\Traits\CommandsTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MyCustomCommand extends Command {

	use CommandsTrait;

	protected function configure(): void {
		$this
			->setName('make:admin-page')
			->setDescription('Create a new admin page.          | Eg: bin/console make:template custom-admin-page')
			->setHelp('This command allows you to create an admin page.')
			->addArgument('path', InputArgument::OPTIONAL, 'The path of the admin page.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$path = $input->getArgument('path');

		// If path is empty.
		$helper = $this->getHelper('question');
		if (!$path) {
			$pathQuestion = new Question('Please enter the path of the admin page: ', 'custom-admin-page-path');
			$path         = $helper->ask($input, $output, $pathQuestion);

			if (empty($path)) {
				$output->writeln('Missing path for the admin page. Please try again.');
				return Command::INVALID;
			}
		}

		// Define variables.
		$pathSlugify = Slugify::slugUnify($path, '-');
		$name = $path;
		$nameSlugify = Slugify::slugUnify($name, '_');

		// Check exist.
		$exist = FileHandler::getFileSystem()->exists(__DIR__ . '/../../Extend/Components/AdminPages/' . $nameSlugify . '.php');
		$exist = $exist || FileHandler::getFileSystem()->exists(__DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path);
		if ($exist) {
			$output->writeln('[ERROR] Admin page: "' . $path . '" already exists! Please try again.');
			return Command::FAILURE;
		}

		// Create class file.
		$content = FileHandler::getFileSystem()->get(__DIR__ . '/../Stubs/AdminPages/adminpage.stub');
		$content = str_replace('{{ className }}', $nameSlugify, $content);
		$content = str_replace('{{ name }}', $name, $content);
		$content = str_replace('{{ name_slugify }}', $nameSlugify, $content);
		$content = str_replace('{{ path }}', $path, $content);
		$content = str_replace('{{ path_slugify }}', $pathSlugify, $content);
		$content = $this->replaceRootNamespace($content);
		FileHandler::saveFile($content, __DIR__ . '/../../Extend/Components/AdminPages/' . $nameSlugify . '.php');

		// Create view directory.
		FileHandler::getFileSystem()->makeDirectory(__DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path);

		// Create main view file.
		$view = FileHandler::getFileSystem()->get(__DIR__ . '/../Views/AdminPages/adminpage.view');
		$view = str_replace('{{ name }}', $name, $view);
		$view = str_replace('{{ name_slugify }}', $nameSlugify, $view);
		$view = str_replace('{{ path }}', $path, $view);
		$view = str_replace('{{ path_slugify }}', $pathSlugify, $view);
		FileHandler::saveFile($view, __DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path . '/main.blade.php');

		// Create dashboard view file.
		$view = FileHandler::getFileSystem()->get(__DIR__ . '/../Views/AdminPages/dashboard.view');
		$view = str_replace('{{ name }}', $name, $view);
		$view = str_replace('{{ name_slugify }}', $nameSlugify, $view);
		$view = str_replace('{{ path }}', $path, $view);
		$view = str_replace('{{ path_slugify }}', $pathSlugify, $view);
		FileHandler::saveFile($view, __DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path . '/dashboard.blade.php');

		// Create "Tab 1" view file.
		$view = FileHandler::getFileSystem()->get(__DIR__ . '/../Views/AdminPages/tab-1.view');
		$view = str_replace('{{ name }}', $name, $view);
		$view = str_replace('{{ name_slugify }}', $nameSlugify, $view);
		$view = str_replace('{{ path }}', $path, $view);
		$view = str_replace('{{ path_slugify }}', $pathSlugify, $view);
		FileHandler::saveFile($view, __DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path . '/tab-1.blade.php');

		// Create navigation view file.
		$view = FileHandler::getFileSystem()->get(__DIR__ . '/../Views/AdminPages/navigation.view');
		$view = str_replace('{{ name }}', $name, $view);
		$view = str_replace('{{ name_slugify }}', $nameSlugify, $view);
		$view = str_replace('{{ path }}', $path, $view);
		$view = str_replace('{{ path_slugify }}', $pathSlugify, $view);
		FileHandler::saveFile($view, __DIR__ . '/../../../resources/views/modules/web/admin-pages/' . $path . '/navigation.blade.php');

		// Prepare new line for find function.
		$func = FileHandler::getFileSystem()->get(__DIR__ . '/../Funcs/AdminPages/adminpage.func');
		$func = str_replace('{{ name }}', $name, $func);
		$func = str_replace('{{ name_slugify }}', $nameSlugify, $func);
		$func = str_replace('{{ path }}', $path, $func);
		$func = str_replace('{{ path_slugify }}', $pathSlugify, $func);

		// Prepare new line for use class.
		$use = FileHandler::getFileSystem()->get(__DIR__ . '/../Uses/AdminPages/adminpage.use');
		$use = str_replace('{{ name }}', $name, $use);
		$use = str_replace('{{ name_slugify }}', $nameSlugify, $use);
		$use = str_replace('{{ path }}', $path, $use);
		$use = str_replace('{{ path_slugify }}', $pathSlugify, $use);
		$use = $this->replaceRootNamespace($use);

		// Add class to route.
		$this->addClassToWebRoute('admin_pages', $func, $use);

		// Output message.
		$output->writeln('Created new admin page: "' . $path . '"');

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