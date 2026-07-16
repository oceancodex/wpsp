<?php
/**
 * Name: 			Laravel Debugbar
 * Description:		Integrate Laravel Debugbar.
 * Version:			1.0.0
 * Author:			OceanCodex
 * Requires WP:		6.4
 * Requires WPSP:	13.0
 * Requires PHP:	8.3
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

		Funcs::app()->make('config')->set('debugbar.options.views.timeline', false);
		if (
			!Funcs::app()->runningInConsole()
			&& Funcs::config('app.debug') === true
			&& Funcs::config('app.debug_monitor') === true
			&& class_exists('\Fruitcake\LaravelDebugbar\LaravelDebugbar')
		) {
			/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
			add_action('shutdown', function() {
				if (
					!wp_doing_ajax()
					&& !wp_doing_cron()
					&& !wp_is_serving_rest_request()
					&& !defined('REST_REQUEST')
				) {
					/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
					$debugbar = Funcs::app('debugbar');
					if ($debugbar) {
						$wpspRouteCollector = Funcs::app()->make(WPSPRouteCollector::class, ['routeManagerInstance' => RouteManager::instance()]);

						$debugbar->addCollector($wpspRouteCollector);

						$debugbarJsHeader = $debugbar->getJavascriptRenderer()->renderHead();
						$debugbarJsFooter = $debugbar->getJavascriptRenderer()->render();

						echo $debugbarJsHeader;
						echo $debugbarJsFooter;
					}
				}
			}, PHP_INT_MAX);
		}
		
		$this->afterBindings();
	}

	public function afterBindings() {
		// Chỉ thực hiện nếu ứng dụng có sử dụng View và Debugbar
		if (Funcs::app()->bound('view') && Funcs::app()->bound('debugbar')) {

			// --- BƯỚC QUYẾT ĐỊNH: BẺ KHÓA VÀ GỠ BỎ EVENT LISTENER MẶC ĐỊNH ---
			if (Funcs::app()->bound('events')) {
				/** @var \Illuminate\Events\Dispatcher $events */
				$events = Funcs::app()['events'];

				// Lấy tất cả listeners đang lắng nghe sự kiện composing của View
				$listeners = $events->getListeners('composing:*');

				foreach ($listeners as $listener) {
					// Thường Listener mặc định của Debugbar là một Closure hoặc Object chứa class Debugbar/ViewCollector
					// Chúng ta sẽ kiểm tra cấu trúc của listener để loại bỏ một cách an toàn
					$isDebugbarListener = false;

					if ($listener instanceof \Closure) {
						$ref = new \ReflectionFunction($listener);
						// Kiểm tra xem Closure đó có sử dụng biến liên quan đến Debugbar hay không
						if (str_contains($ref->getFileName() ?: '', 'laravel-debugbar')) {
							$isDebugbarListener = true;
						}
					}

					// Nếu đúng là Listener mặc định của Debugbar, tiến hành "trảm" nó
					if ($isDebugbarListener) {
						$events->forget('composing:*');
						// Lưu ý: Nếu gỡ sạch 'composing:*', các composer view của bạn (nếu có) có thể bị ảnh hưởng.
						// Để an toàn tuyệt đối, ta chỉ cần tắt chức năng của collector 'views' bằng cách gỡ collector này ra:
						/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
						$debugbar = Funcs::app()['debugbar'];
						if ($debugbar->hasCollector('views')) {
							$debugbar->removeCollector('views');
						}
						break;
					}
				}
			}

			Funcs::app()->extend('view.engine.resolver', function ($resolver, $app) {
				/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
				$debugbar = $app->make('debugbar');

				// Chỉ can thiệp nếu debugbar đang bật và đo thời gian
				if ($debugbar->isEnabled() && $debugbar->shouldCollect('time')) {

					// Lấy ra Blade Engine mặc định của Laravel
					$bladeEngine = $resolver->resolve('blade');

					// Đăng ký một phiên bản "đã được bọc bộ đo" thay thế cho engine mặc định
					$resolver->register('blade', function () use ($bladeEngine, $debugbar) {
						return new class($bladeEngine, $debugbar) implements \Illuminate\Contracts\View\Engine {
							public function __construct(
								protected \Illuminate\Contracts\View\Engine $engine,
								protected $debugbar
							) {}

							public function get($path, array $data = []) {
								// 1. Tìm tên view dạng chấm (dot notation) từ path file
								$viewName = $this->getViewNameFromPath($path);

								// 2. Gán nhãn hiển thị trực tiếp lên Timeline chính xác là "view: {tên_view}"
								$measureLabel = "view: " . $viewName;

								// Dùng key duy nhất (unique key) bằng hash để không bị lồng đè thời gian của các view con
								$measureKey = 'view_render_' . md5($path);

								// Bắt đầu đo
								$this->debugbar['time']?->startMeasure($measureKey, $measureLabel);

								// Thực thi render nguyên bản của Laravel
								$result = $this->engine->get($path, $data);

								// Dừng đo
								$this->debugbar['time']?->stopMeasure($measureKey);

								return $result;
							}

							/**
							 * Helper convert ngược từ file path sang tên view của Laravel (ví dụ: admin-pages.wpsp.main)
							 */
							protected function getViewNameFromPath($path): string {
								$viewName = str_replace('\\', '/', $path);

								// Tìm vị trí thư mục views
								if (preg_match('/\/views\/(.*)\.blade\.php$/', $viewName, $matches)) {
									return str_replace('/', '.', $matches[1]);
								}

								// Trả về tên file gốc ngắn gọn nếu không nằm trong thư mục views tiêu chuẩn
								return basename($path, '.blade.php');
							}
						};
					});
				}

				return $resolver;
			});
		}
	}

}