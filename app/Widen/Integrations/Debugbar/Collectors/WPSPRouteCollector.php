<?php

namespace WPSP\App\Widen\Integrations\Debugbar\Collectors;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;
use WPSP\App\Widen\Routes\RouteManager;

class WPSPRouteCollector extends DataCollector implements Renderable {

	public function collect(): array {
		$route = RouteManager::instance()->currentRoute();

		if (!$route) {
			return [];
		}

		// Loại bỏ Route khỏi params để tránh vòng lặp.
		unset($route->parameters['route']);

		return [
			'name'            => $route->name,
			'method'          => strtoupper($route->method),
			'path'            => $route->path,
			'path_regex'      => $route->pathRegex,
			'full_path'       => $route->fullPath,
			'full_path_regex' => $route->fullPathRegex,
			'callback'        => $this->formatCallback($route->callback),
			'middlewares'     => $this->formatMiddlewares($route->middlewares),
			'parameters'      => '<pre>'.e(print_r($route->parameters, true)).'</pre>',
			'args'            => '<pre>'.e(print_r($route->args, true)).'</pre>', // "args" là tham số thứ 3 trong Route. Ví dụ: Route::get(name, callback, args)
		];
	}

	public function getName(): string {
		return 'wpsp_route';
	}

	public function getWidgets(): array {
		return [
			"WPSP Route" => [
				"icon"    => "road",
				"widget"  => "PhpDebugBar.Widgets.HtmlVariableListWidget",
				"map"     => "wpsp_route",
				"default" => "{}",
			],
		];
	}

	protected function formatCallback($callback): string {
		if ($callback instanceof \Closure) {
			return 'Closure';
		}

		if (is_array($callback)) {
			return $callback[0].'@'.($callback[1] ?? 'null');
		}

		return (string)$callback;
	}

	protected function formatMiddlewares(array $middlewares): array {
		return array_map(function($group) {
			if (!is_array($group)) {
				return (string)$group;
			}

			$relation = $group['relation'] ?? 'AND';

			unset($group['relation']);

			$items = [];

			foreach ($group as $middleware) {
				if (is_array($middleware)) {
					$items[] = sprintf(
						'%s@%s',
						class_basename($middleware[0]),
						$middleware[1] ?? 'handle'
					);
				}
				else {
					$items[] = class_basename($middleware);
				}
			}

			return sprintf(
				' [%s] > %s',
				$relation,
				implode(', ', $items)
			);

		}, $middlewares);
	}

}