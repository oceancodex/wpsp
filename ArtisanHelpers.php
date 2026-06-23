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

function getEnvironmentVariables(string $file = '.env'): array {
	$result = [];

	foreach (file($file, FILE_IGNORE_NEW_LINES) as $line) {
		$line = trim($line);

		if ($line === '' || str_starts_with($line, '#')) {
			continue;
		}

		if (!str_contains($line, '=')) {
			continue;
		}

		[$key, $value] = explode('=', $line, 2);

		$key   = trim($key);
		$value = trim($value);

		// Xóa comment cuối dòng
		// VD: value # comment
		// nhưng giữ lại # nếu nằm trong dấu nháy
		if (
			preg_match(
				'/^("([^"\\\\]|\\\\.)*"|\'([^\'\\\\]|\\\\.)*\'|[^#]*)/',
				$value,
				$matches
			)
		) {
			$value = trim($matches[0]);
		}

		// Bỏ dấu nháy bao ngoài
		if (
			strlen($value) >= 2 &&
			(
				($value[0] === '"' && $value[-1] === '"') ||
				($value[0] === "'" && $value[-1] === "'")
			)
		) {
			$value = substr($value, 1, -1);
		}

		$result[$key] = $value;
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
function ensureDBConnect(array $wpConfig = [], array $environment = []): bool {
	$cacheFile = sys_get_temp_dir() . '/wpsp_db_connect.cache';
	$ttl       = 3600;

	// Nếu cache còn hạn thì dùng lại
	if (file_exists($cacheFile)) {
		$cache = json_decode(file_get_contents($cacheFile), true);

		if (
			is_array($cache) &&
			isset($cache['time'], $cache['result']) &&
			(time() - $cache['time']) < $ttl
		) {
			return (bool)$cache['result'];
		}
	}

	if (empty($wpConfig)) {
		$wpConfig = getWPConfig();
	}

	if (empty($environment)) {
		$environmentVariables = getEnvironmentVariables();
	}

	try {
		$connection = $wpConfig['DB_CONNECTION'] ?? $environmentVariables['WPSP_DB_CONNECTION'] ?? 'mysql';
		$host       = $wpConfig['DB_HOST'] ?? $environmentVariables['WPSP_DB_HOST'] ?? 'localhost';
		$port       = $wpConfig['DB_PORT'] ?? $environmentVariables['WPSP_DB_PORT'] ?? '3306';
		$database   = $wpConfig['DB_NAME'] ?? $environmentVariables['WPSP_DB_DATABASE'] ?? 'local';
		$user       = $wpConfig['DB_USER'] ?? $environmentVariables['WPSP_DB_USERNAME'] ?? 'root';
		$password   = $wpConfig['DB_PASSWORD'] ?? $environmentVariables['WPSP_DB_PASSWORD'] ?? '';
		$charset    = $wpConfig['DB_CHARSET'] ?? $environmentVariables['WPSP_DB_CHARSET'] ?? 'utf8mb4';


		$dsn = sprintf(
			'mysql:host=%s;port=%s;dbname=%s;charset=%s',
			$host,
			$port,
			$database,
			$charset
		);

		$pdo = new PDO(
			$dsn,
			$user,
			$password,
			[
				PDO::ATTR_TIMEOUT            => 3,
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]
		);

		$table = $wpConfig['table_prefix'] . 'options';

		$stmt = $pdo->prepare('SHOW TABLES LIKE ?');
		$stmt->execute([$table]);

		$result = (bool)$stmt->fetch();
	}
	catch (Throwable $e) {
		$result = false;
	}

	// Lưu cache 60 giây
	file_put_contents($cacheFile, json_encode([
		'time'   => time(),
		'result' => $result,
	]));

	return $result;
}