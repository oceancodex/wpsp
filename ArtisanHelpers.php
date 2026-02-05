<?php

function getWPConfig($file = null): array {
	if (!$file) {
		$file = __DIR__ . '/../../../wp-config.php';
	}

	if (!file_exists($file)) {
		return [];
	}

	$result = [];

	$tokens = token_get_all(file_get_contents($file));
	$count  = count($tokens);

	for ($i = 0; $i < $count; $i++) {

		/* ===============================
		 * Parse define('KEY', 'VALUE')
		 * =============================== */
		if (
			is_array($tokens[$i]) &&
			$tokens[$i][0] === T_STRING &&
			strtolower($tokens[$i][1]) === 'define'
		) {
			$j = $i + 1;

			while ($j < $count && is_array($tokens[$j]) &&
				in_array($tokens[$j][0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT])) {
				$j++;
			}

			if ($j >= $count || $tokens[$j] !== '(') {
				continue;
			}

			$j++;
			while ($j < $count && is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE) {
				$j++;
			}

			if (!is_array($tokens[$j]) || $tokens[$j][0] !== T_CONSTANT_ENCAPSED_STRING) {
				continue;
			}
			$key = trim($tokens[$j][1], "\"'");

			while ($j < $count && $tokens[$j] !== ',') {
				$j++;
			}
			if ($j >= $count) continue;

			$j++;
			while ($j < $count && is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE) {
				$j++;
			}

			if (!is_array($tokens[$j]) || $tokens[$j][0] !== T_CONSTANT_ENCAPSED_STRING) {
				continue;
			}

			$value        = trim($tokens[$j][1], "\"'");
			$result[$key] = $value;
		}

		/* ===============================
		 * Parse $table_prefix = 'wp_';
		 * =============================== */
		if (
			is_array($tokens[$i]) &&
			$tokens[$i][0] === T_VARIABLE &&
			$tokens[$i][1] === '$table_prefix'
		) {
			$j = $i + 1;

			while ($j < $count && is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE) {
				$j++;
			}

			if ($j >= $count || $tokens[$j] !== '=') {
				continue;
			}

			$j++;
			while ($j < $count && is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE) {
				$j++;
			}

			if (!is_array($tokens[$j]) || $tokens[$j][0] !== T_CONSTANT_ENCAPSED_STRING) {
				continue;
			}

			$result['table_prefix'] = trim($tokens[$j][1], "\"'");
		}
	}

	return $result;
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
		empty($wpConfig['DB_USER']) ||
		empty($wpConfig['table_prefix'])
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

		$pdo = new PDO(
			$dsn,
			$wpConfig['DB_USER'],
			$wpConfig['DB_PASSWORD'] ?? '',
			[
				PDO::ATTR_TIMEOUT => 3,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]
		);

		$table = $wpConfig['table_prefix'] . 'options';

		$stmt = $pdo->prepare('SHOW TABLES LIKE ?');
		$stmt->execute([$table]);

		return (bool)$stmt->fetch();
	}
	catch (Throwable $e) {
		return false;
	}
}