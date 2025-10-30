<?php

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
