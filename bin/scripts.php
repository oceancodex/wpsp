<?php

function color($text, $color = 'default') {
	$colors = [
		'default' => "\e[0m",
		'red'     => "\e[31m",
		'green'   => "\e[32m",
		'yellow'  => "\e[33m",
		'blue'    => "\e[34m",
		'cyan'    => "\e[36m",
		'bold'    => "\e[1m",
	];

	return ($colors[$color] ?? $colors['default']) . $text . $colors['default'];
}

$projectDir  = getcwd();
$projectName = basename($projectDir);
$dirs        = ['.github',];

foreach ($dirs as $dir) {
	if (!is_dir($dir)) continue;
	$it = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
		RecursiveIteratorIterator::CHILD_FIRST
	);
	foreach ($it as $file)
		$file->isDir() ? @rmdir($file) : @unlink($file);
	@rmdir($dir);
}

echo "\n";
echo color('Congratulation! The plugin "'.$projectName.'" created successfully!', 'green');
echo "\n\n";