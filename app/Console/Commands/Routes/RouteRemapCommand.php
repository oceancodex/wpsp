<?php

namespace WPSP\App\Console\Commands\Routes;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use WPSP\WPSP;

class RouteRemapCommand extends Command {

	/**
	 * Tên & tham số lệnh Artisan.
	 *
	 * @var string
	 */
	protected $signature = 'route:remap 
		{--ide= : Choose IDE to auto-reload. Supported: phpstorm} 
		{--ignore-active-plugin : Ignore active plugin check.}';

	/**
	 * Mô tả của command.
	 *
	 * @var string
	 */
	protected $description = 'Remap WordPress routes and generate .wpsp-routes.json for IDE / plugin sync.';

	/**
	 * Thực thi command.
	 */
	public function handle(): int {
		$appInstance = WPSP::instance();
		$app         = $appInstance->application();
		$funcs       = $appInstance->funcs ?? null;

		if (!$funcs) {
			$this->error('Unable to resolve application funcs. Application not booted?');
			return 0;
		}

		$ignoreActivePlugin = $this->option('ignore-active-plugin') ?? false;

		if ($ignoreActivePlugin) {
			$wpConfig = $funcs->_getWPConfig();
			$host     = $wpConfig['DB_HOST'] ?? $funcs->_env('DB_HOST', true) ?? null;
			$user     = $wpConfig['DB_USER'] ?? $funcs->_env('WPSP_DB_USERNAME', true) ?? null;
			$password = $wpConfig['DB_PASSWORD'] ?? $funcs->_env('DB_PASSWORD', true) ?? null;

			if (!$host) {
				$this->error('WP Config not found or database connection information in .env file is not configured.');
				return 0;
			}

			try {
				$test = @mysqli_connect($host, $user, $password);
				if (!$test) {
					$this->error('Unable to connect to database. Check wp-config.php or .env.');
					return 0;
				}
			}
			catch (\Throwable $e) {
				$this->error('Database server not found: ' . $e->getMessage());
				return 0;
			}

			require $funcs->_getSitePath('/wp-config.php');

			$routeMap = $funcs->getRouteMap()->getMapIdea() ?? [];
			if (empty($routeMap)) {
				$this->error('No routes found! Ensure the database server is running.');
				return 0;
			}

			$pluginDirName = $funcs->_getPluginDirName();

			$prepareMap = [
				'scope'  => $pluginDirName,
				'routes' => $routeMap,
			];

			$json = json_encode($prepareMap, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
			FileSystem::put($app->basePath('.wpsp-routes.json'), $json);

			// IDE auto-reload
			$ide = strtolower($this->option('ide') ?? '');
			if ($ide === 'phpstorm') {
				$this->info('[IDE] Auto reload triggered for PHPStorm');
				$psScript = $funcs->_getMainPath('/bin/phpstorm-auto-reload.ps1');
				exec('pwsh ' . escapeshellarg($psScript));
			}

			$this->info('Remap routes successfully!');
			return 1;
		}

		// Nếu không có flag ignore-active-plugin, thử active plugin trước
		$pluginActivated = $this->maybeActivePlugin($funcs->_getMainBaseName() . '/main.php');

		if ($pluginActivated === true) {
			passthru('php artisan route:remap --ignore-active-plugin 2>&1');
		}
		elseif ($pluginActivated === 'activated') {
			// Gọi lại chính nó nhưng bỏ qua plugin check
			return $this->call('route:remap', ['--ignore-active-plugin' => true]);
		}

		return 0;
	}

	protected function maybeActivePlugin(string $plugin) {
		$funcs = WPSP::instance()->application()['funcs'] ?? null;

		if (!$funcs) return false;

		try {
			$pluginName = dirname($plugin);
			$pluginSlug = $plugin;

			if ($this->isPluginActiveFast($funcs->_getMainBaseName() . '/main.php')) {
				return 'activated';
			}

			$this->line('<fg=yellow>Loading WordPress...</>');
			require_once $funcs->_getSitePath('/wp-load.php');

			if (is_plugin_active($pluginSlug)) {
				return 'activated';
			}

			$this->line("<fg=yellow>Activating plugin \"{$pluginName}\" ...</>");
			$res = activate_plugin($pluginSlug);

			if (is_wp_error($res)) {
				$this->error("Failed to activate plugin: {$pluginName} - {$res->get_error_message()}");
				return false;
			}

			if (!is_plugin_active($pluginSlug)) {
				$this->warn("Activation succeeded but plugin still inactive: {$pluginName}");
				return false;
			}

			$this->info("Plugin \"{$pluginName}\" activated successfully!");
			return true;
		}
		catch (\Throwable $e) {
			$this->error("Error activating plugin {$plugin}: " . $e->getMessage());
			return false;
		}
	}

	protected function isPluginActiveFast(string $plugin): bool {
		$funcs = WPSP::instance()->application()['funcs'] ?? null;

		if (!$funcs) return false;

		try {
			$wpConfig = $funcs->_getWPConfig();
			$prefix   = $wpConfig['table_prefix'] ?? 'wp_';
			$host     = $wpConfig['DB_HOST'] ?? null;
			$user     = $wpConfig['DB_USER'] ?? null;
			$password = $wpConfig['DB_PASSWORD'] ?? null;
			$database = $wpConfig['DB_NAME'] ?? null;

			$mysqli = @new \mysqli($host, $user, $password, $database);
			if ($mysqli->connect_error) return false;

			$result = $mysqli->query("SELECT option_value FROM {$prefix}options WHERE option_name='active_plugins' LIMIT 1");
			if (!$result) return false;

			$row    = $result->fetch_assoc();
			$active = @unserialize($row['option_value']);
			return is_array($active) && in_array($plugin, $active, true);
		}
		catch (\Throwable $e) {
			$this->error('isPluginActiveFast error: ' . $e->getMessage());
			return false;
		}
	}

}