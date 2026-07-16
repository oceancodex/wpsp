<?php
/**
 * Name:            Laravel Debugbar
 * Description:     Integrate Laravel Debugbar.
 * Version:         1.0.0
 * Author:          OceanCodex
 * Requires WP:     6.4
 * Requires WPSP:   13.0
 * Requires PHP:    8.3
 */

namespace WPSP\App\Widen\Integrations\LaravelDebugbar;

use WPSP\App\Widen\Integrations\LaravelDebugbar\Collectors\WPSPRouteCollector;
use WPSP\App\Widen\Routes\RouteManager;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Integrations\BaseIntegration;

class LaravelDebugbar extends BaseIntegration {

	use InstancesTrait;

	public $activate = true;

	/*
	 *
	 */

	public function init() {
		if (
			Funcs::app()->runningInConsole()
			|| Funcs::config('app.debug') !== true
			|| Funcs::config('app.debug_monitor') !== true
			|| !class_exists('\Fruitcake\LaravelDebugbar\LaravelDebugbar')
			|| wp_doing_ajax()
			|| wp_doing_cron()
			|| wp_is_serving_rest_request()
			|| defined('REST_REQUEST')
		) {
			return;
		}

		/** @var \Illuminate\Foundation\Application $app */
		$app = Funcs::app();

		if (!$app->bound('view') || !$app->bound('debugbar')) {
			return;
		}

		/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
		$debugbar = $app->make('debugbar');

		/**
		 * ---
		 * Timeline - Routes
		 * ---
		 */
//		add_action($this->funcs->_getAppShortName() . '_add_matched_route', function($routeItem, $measureKey) use ($debugbar) {
//			$debugbar['time']->startMeasure($measureKey, 'Route: '. $routeItem->name, 'Routes', 'Routes');
//		}, 10, 2);
//		add_action($this->funcs->_getAppShortName() . '_after_execute_route', function($routeItem, $measureKey) use ($debugbar) {
//			try {
//				$debugbar['time']->stopMeasure($measureKey);
//			}
//			catch (\Exception $e) {}
//		}, 10, 2);

		/**
		 * ---
		 * Timeline - Views
		 * ---
		 */
		if ($debugbar->isEnabled() && $debugbar->shouldCollect('time')) {
			$app->extend('view.engine.resolver', function($resolver) use ($debugbar) {

				$bladeEngine = $resolver->resolve('blade');

				$resolver->register('blade', function() use ($bladeEngine, $debugbar) {
					return new class($bladeEngine, $debugbar) implements \Illuminate\Contracts\View\Engine {

						public function __construct(
							protected \Illuminate\Contracts\View\Engine $engine,
							protected $debugbar
						) {}

						public function get($path, array $data = []) {
							$viewName = $this->getViewNameFromPath($path);

							$measureLabel = 'View: ' . $viewName;
							$measureKey   = 'view_' . md5($path);

							// Đo đạc & gán vào collector nhóm 'Views'
							$this->debugbar['time']?->startMeasure($measureKey, $measureLabel, 'Views', 'Views');

							$result = $this->engine->get($path, $data);

							$this->debugbar['time']?->stopMeasure($measureKey);

							return $result;
						}

						protected function getViewNameFromPath($path): string {
							$viewName = str_replace('\\', '/', $path);

							if (preg_match('/\/views\/(.*)\.blade\.php$/', $viewName, $matches)) {
								return str_replace('/', '.', $matches[1]);
							}

							return basename($path, '.blade.php');
						}

					};
				});

				return $resolver;
			});
		}

		/**
		 * ---
		 * Tính toán và hiển thị Laravel Debugbar.
		 * ---
		 */
		// 1. ĐĂNG KÝ SHUTDOWN HOOK
		add_action('shutdown', function() use ($app, $debugbar) {
			if ($debugbar->hasCollector('time')) {
				/** @var \DebugBar\DataCollector\TimeDataCollector $timeCollector */
				$timeCollector = $debugbar->getCollector('time');

				// Lấy gốc thời gian thực tế của WordPress
//				$wpStartTime = $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true);
//				$timeCollector->setRequestStartTime($wpStartTime);

				// --- ĐO THỜI GIAN KHỞI TẠO ĐẾN SAU KHI BOOT ---
//				if ($app->bound('bootstrap_start_time') && $app->bound('boot_time')) {
//					$bootstrapStart = $app->make('bootstrap_start_time');
//					$bootFinished   = $app->make('boot_time');
//
//					// Tạo thanh Timeline "Application" đo chính xác khoảng thời gian này
//					$timeCollector->addMeasure(
//						'Application',				// Nhãn hiển thị trên thanh timeline
//						$bootstrapStart,			// Thời gian bắt đầu khởi tạo
//						$bootFinished,				// Thời gian boot xong
//						[],                      // Các tham số phụ
//						'WPSP Boot Lifecycle'	// Gom nhóm dòng chữ vàng
//					);
//				}

				// --- ĐO THỜI GIAN XỬ LÝ VÀ GỬI RESPONSE ---
//				if ($app->bound('start_handle_request_time') && $app->bound('after_handle_request_time')) {
//					$startHandleRequest = $app->make('start_handle_request_time');
//					$afterHandleRequest = $app->make('after_handle_request_time');
//
//					// Tạo thanh Timeline "Application" đo chính xác khoảng thời gian này
//					$timeCollector->addMeasure(
//						'Response',			// Nhãn hiển thị trên thanh timeline
//						$startHandleRequest,	// Thời gian bắt đầu
//						$afterHandleRequest,	// Thời gian xử lý xong
//						[],					// Các tham số phụ
//						'Response'			// Gom nhóm dòng chữ vàng
//					);
//				}

				// Vẽ thanh Timeline tổng bao quát toàn bộ vòng đời của Request
//				$timeCollector->addMeasure('WPSP Full Lifecycle', $wpStartTime, microtime(true), [], 'time');

				// --- BỘ LỌC DỌN DẸP VIEWS RÁC VÀ APPLICATION MẶC ĐỊNH ---
				$refObject   = new \ReflectionObject($timeCollector);

				// Xóa thanh application ảo mặc định của laravel-debugbar
//				$refStarted  = $refObject->getProperty('startedMeasures');
//				$startedMeasures = $refStarted->getValue($timeCollector);
//				if (isset($startedMeasures['application'])) {
//					unset($startedMeasures['application']);
//					$refStarted->setValue($timeCollector, $startedMeasures);
//				}

				// Lọc bỏ danh sách measures rác
				$measures = $timeCollector->getMeasures();
				$filteredMeasures = array_filter($measures, function($measure) {
					$collector = $measure['collector'] ?? '';
					if ($collector === 'views' || $collector === 'view') {
						return false;
					}
					$label = $measure['label'] ?? '';
					if (str_starts_with($label, 'view: rendering') || str_starts_with($label, 'render: ')) {
						return false;
					}
					return true;
				});

				$refProperty = $refObject->getProperty('measures');
				$refProperty->setValue($timeCollector, array_values($filteredMeasures));
			}

			// Khởi tạo & add Route Collector
			$wpspRouteCollector = $app->make(WPSPRouteCollector::class, [
				'routeManagerInstance' => RouteManager::instance()
			]);
			$debugbar->addCollector($wpspRouteCollector);

			// Render debugbar
			$renderer = $debugbar->getJavascriptRenderer();
			echo $renderer->renderHead();
			echo $renderer->render();
		}, PHP_INT_MAX);
	}

}