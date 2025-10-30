<?php
$projectDir = getcwd();
$projectName = basename($projectDir);

$dirs = ['.github']; // thêm folder khác nếu muốn

foreach ($dirs as $dir) {
	if (!is_dir($dir)) continue;

	$it = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
		RecursiveIteratorIterator::CHILD_FIRST
	);

	foreach ($it as $file)
		$file->isDir() ? @rmdir($file) : @unlink($file);

	@rmdir($dir);
//	echo "🧹 Deleted: $dir\n";
}

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	system('');
}

echo "\n";
echo "\e[32m Congratulation! The plugin name: \"{$projectName}\" created successfully!\e[0m\n";