<?php

namespace WPSP\App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use WPSP\App\Widen\Support\Facades\Blade;
use WPSP\App\Widen\Support\Facades\RateLimiter;
use WPSP\Funcs;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot() {
		RateLimiter::for('30rpm', function (\Illuminate\Http\Request $request) {
			return Limit::perMinute(30);
		});

		// Định nghĩa directive @currency($amount) để định dạng tiền tệ VNĐ
		Blade::directive('currency', function ($expression) {
			return "<?php echo number_format($expression) . ' VNĐ'; ?>";
		});

		//
//		View::addNamespace('errors', resource_path('views/errors'));
		$this->loadViewsFrom(Funcs::getResourcesPath('/views/errors'), 'errors');
	}

}