<?php

namespace WPSP\App\Widen\Integrations\Debugbar\Collectors;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;
use WPSP\App\Widen\Routes\RouteManager;

class WPSPRouteCollector extends DataCollector implements Renderable {

	public function collect(): array {
		$routes = RouteManager::instance()->matchedRoutes();

		$data = [];

		foreach ($routes as $i => $route) {
			unset($route->parameters['route']);

			$prefix = '#'.($i + 1);

			$data['Route '.$prefix.' ----------------------------------------'] = '------------------------------------------------------------------------------------------------------------------------------------------------------';

			$data['ㅏ '.$prefix.' - Name']            = $route->name;
			$data['ㅏ '.$prefix.' - Method']          = strtoupper($route->method);
			$data['ㅏ '.$prefix.' - Path']            = e($route->path);
			$data['ㅏ '.$prefix.' - Path regex']      = e($route->pathRegex);
			$data['ㅏ '.$prefix.' - Full path']       = e($route->fullPath);
			$data['ㅏ '.$prefix.' - Full path regex'] = e($route->fullPathRegex);
			$data['ㅏ '.$prefix.' - Callback']        = $this->formatCallback($route->callback);

			$middlewares = $this->formatMiddlewares($route->middlewares);

			$data['ㅏ '.$prefix.' - Middlewares'] = empty($middlewares)
				? null
				: '<pre>'.e(implode(PHP_EOL, $middlewares)).'</pre>';

			$data['ㅏ '.$prefix.' - Parameters'] = empty($route->parameters)
				? null
				: '<pre>'.e(print_r($route->parameters, true)).'</pre>';

			$data['ㅏ '.$prefix.' - Args'] = empty($route->args)
				? null
				: '<pre>'.e(print_r($route->args, true)).'</pre>';
		}

		$data['-------------------------------------------------'] = '------------------------------------------------------------------------------------------------------------------------------------------------------';

		$data['matched_routes'] = count($routes);

		return $data;
	}

	public function getName(): string {
		return 'wpsp_routes';
	}

	public function getWidgets(): array {
		return [
			'WPSP Routes' => [
				'icon'    => 'road',
				'widget'  => 'PhpDebugBar.Widgets.HtmlVariableListWidget',
				'map'     => 'wpsp_routes',
				'default' => '{}',
			],

			'WPSP Routes:badge' => [
				'map'     => 'wpsp_routes.matched_routes',
				'default' => 0,
			],
		];
	}

	protected function formatCallback($callback): string {
		if ($callback instanceof \Closure) {
			return 'Closure';
		}

		if (is_array($callback)) {
//			return class_basename($callback[0]).'@'.($callback[1] ?? '__invoke');
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
					if (str_contains($middleware[0], ':')) {
						$items[] = sprintf(
							'%s',
							class_basename($middleware[0])
						);
					}
					else {
						$items[] = sprintf(
							'%s@%s',
							class_basename($middleware[0]),
							$middleware[1] ?? 'handle'
						);
					}
				}
				else {
					$items[] = class_basename($middleware);
				}
			}

			return sprintf(
				'[%s] %s',
				$relation,
				implode(', ', $items)
			);

		}, $middlewares);
	}

}