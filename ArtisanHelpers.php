<?php

function getWPConfig($file = null) {
	if (!$file) {
		$file = __DIR__ . '/../../../wp-config.php';
	}

	if (!file_exists($file)) {
		return [];
	}

	$defines = [];
	$tokens  = token_get_all(file_get_contents($file));

	$count = count($tokens);
	for ($i = 0; $i < $count; $i++) {

		// Tìm keyword define
		if (is_array($tokens[$i]) && $tokens[$i][0] === T_STRING && strtolower($tokens[$i][1]) === 'define') {

			// Kiểm tra dấu mở ngoặc
			$j = $i + 1;
			while ($j < $count && is_array($tokens[$j]) && in_array($tokens[$j][0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT])) {
				$j++;
			}

			if ($j >= $count || $tokens[$j] !== '(') {
				continue;
			}

			// Lấy tham số đầu tiên (key)
			$j++;
			while ($j < $count && (is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE)) {
				$j++;
			}

			if (!is_array($tokens[$j]) || $tokens[$j][0] !== T_CONSTANT_ENCAPSED_STRING) {
				continue;
			}
			$key = trim($tokens[$j][1], "\"'");

			// Tìm dấu phẩy
			do {
				$j++;
			}
			while ($j < $count && $tokens[$j] !== ',');

			if ($j >= $count) continue;

			// Lấy tham số thứ hai (value)
			$j++;
			while ($j < $count && (is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE)) {
				$j++;
			}

			if (!is_array($tokens[$j]) || $tokens[$j][0] !== T_CONSTANT_ENCAPSED_STRING) {
				continue;
			}
			$value = trim($tokens[$j][1], "\"'");

			$defines[$key] = $value;
		}
	}

	return $defines;
}

/**
 * Kiểm tra kết nối MySQL/MariaDB
 *
 * @param array $wpConfig
 *
 * @return bool
 */
function ensureDBConnect(array $wpConfig = []): bool {
	if (empty($wpConfig)) {
		$wpConfig = getWPConfig();
	}

	if (
		empty($wpConfig['DB_HOST']) ||
		empty($wpConfig['DB_NAME']) ||
		empty($wpConfig['DB_USER'])
	) {
		return false;
	}

	try {
		$dsn = sprintf(
			'mysql:host=%s;dbname=%s;charset=%s',
			$wpConfig['DB_HOST'],
			$wpConfig['DB_NAME'],
			$wpConfig['DB_CHARSET'] ?? 'utf8mb4'
		);

		new PDO(
			$dsn,
			$wpConfig['DB_USER'],
			$wpConfig['DB_PASSWORD'] ?? '',
			[
				PDO::ATTR_TIMEOUT => 3,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			]
		);

		return true;
	}
	catch (Throwable $e) {
		return false;
	}
}