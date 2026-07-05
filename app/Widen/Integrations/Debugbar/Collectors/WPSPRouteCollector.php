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

	/*
	 *
	 */

	/**
	 * Định dạng callback của một route thành chuỗi dễ đọc để hiển thị.
	 *
	 * Hỗ trợ các dạng callback:
	 *
	 * - Closure                        → trả về chuỗi "Closure".
	 * - [ClassName::class, 'method']   → trả về chuỗi "ClassName@method".
	 *                                    Nếu không có method, hiển thị "@null".
	 * - Còn lại                        → ép kiểu về string và trả về nguyên bản.
	 *
	 * Lưu ý: tên class được giữ nguyên đầy đủ (fully-qualified). Nếu muốn hiển thị
	 * gọn hơn, có thể dùng class_basename() cho phần tử class (xem dòng đã comment).
	 *
	 * @param mixed $callback Callback của route (Closure, mảng [class, method],
	 *                        hoặc giá trị có thể ép về string).
	 *
	 * @return string Chuỗi mô tả callback đã được định dạng.
	 */
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

	/**
	 * Định dạng toàn bộ danh sách middleware của một route thành mảng các dòng
	 * text có thụt lề, sẵn sàng để hiển thị (ví dụ trong Debugbar).
	 *
	 * Tham số $middlewares là danh sách các "block" middleware ở cấp cao nhất
	 * (top-level). Về mặt ngữ nghĩa, tất cả các block top-level được nối với nhau
	 * bằng quan hệ AND: route chỉ PASS khi toàn bộ các block đều PASS.
	 *
	 * Cách xử lý:
	 *
	 * - Nếu không có middleware nào → trả về mảng rỗng.
	 *
	 * - Nếu có nhiều hơn một block top-level → in một dòng header "┌─ [AND]" để
	 *   thể hiện rõ rằng tất cả các block bên dưới phải cùng PASS, sau đó định dạng
	 *   từng block với độ sâu (depth) bằng 1 để thụt vào trong header tổng.
	 *
	 * - Nếu chỉ có đúng một block → định dạng trực tiếp block đó ở độ sâu 0
	 *   (không cần header AND tổng vì không có block nào khác để nối).
	 *
	 * Việc định dạng chi tiết từng block (kể cả các block con lồng nhau) được
	 * uỷ thác cho {@see formatMiddlewareNode()}.
	 *
	 * Ví dụ kết quả với nhiều block:
	 *
	 * ┌─ [AND]
	 *     ┌─ [OR]
	 *         ㅏ AdministratorCapability@handle
	 *         ㅏ EditorCapability@handle
	 *     ┌─ [OR]
	 *         ㅏ AuthenticationMiddleware@handle
	 *         ㅏ VerifiedUserMiddleware@handle
	 *
	 * @param array $middlewares Danh sách các block middleware top-level của route.
	 *
	 * @return array Mảng các dòng text đã định dạng và thụt lề. Trả về mảng rỗng
	 *               nếu route không có middleware nào.
	 */
	protected function formatMiddlewares(array $middlewares): array {
		if (empty($middlewares)) {
			return [];
		}

		$lines = [];

		// Nhiều block top-level → nối bằng AND, bọc trong header tổng.
		if (count($middlewares) > 1) {
			$lines[] = '┌─ [AND]';
			foreach ($middlewares as $block) {
				$this->formatMiddlewareNode($block, 1, $lines);
			}
		}
		else {
			$this->formatMiddlewareNode($middlewares[0], 0, $lines);
		}

		return $lines;
	}

	/**
	 * Kiểm tra 1 mảng có phải "middleware lá" hay không.\
	 * Lá = [class, method] hoặc [throttle:...]: phần tử [0] là string, không có 'relation'.
	 */
	protected function isLeafMiddleware(array $node): bool {
		if (array_key_exists('relation', $node)) {
			return false;
		}
		return isset($node[0]) && is_string($node[0]);
	}

	/**
	 * Định dạng một node middleware thành các dòng text có thụt lề (indent) và
	 * đẩy vào mảng $lines (truyền theo tham chiếu).
	 *
	 * Một "node" có thể là một trong các dạng sau:
	 *
	 * - Closure                              → middleware dạng closure (lá).
	 * - String                               → tên class middleware đơn (lá).
	 * - [ClassName::class, 'method']         → middleware lá dạng [class, method].
	 * - ['throttle:60,1', ...]               → middleware throttle (lá), nhận diện
	 *                                          qua dấu ':' trong tên.
	 * - ['relation' => 'AND'|'OR', ...con]   → một "block" chứa nhiều middleware con,
	 *                                          có thể lồng nhau nhiều cấp.
	 *
	 * Cách xử lý:
	 *
	 * - Với node lá: in ra một dòng, tiền tố bằng 'ㅏ ' để đánh dấu phần tử.
	 *   Middleware dạng [class, method] sẽ hiển thị theo định dạng "ClassName@method".
	 *   Middleware throttle chỉ hiển thị tên rút gọn (không kèm method).
	 *
	 * - Với node là block: in ra một dòng header dạng "┌─ [RELATION]" thể hiện
	 *   quan hệ đánh giá của block (AND / OR), sau đó đệ quy định dạng từng
	 *   middleware con với độ sâu (depth) tăng thêm 1 để tạo thụt lề.
	 *
	 * Nhờ cơ chế đệ quy, hàm hỗ trợ các block middleware lồng nhau ở độ sâu
	 * bất kỳ, ví dụ:
	 *
	 * ┌─ [AND]
	 *     ┌─ [OR]
	 *         ㅏ throttle:3rpm
	 *         ㅏ EditorCapability@handle
	 *     ┌─ [AND]
	 *         ㅏ AdministratorCapability@handle
	 *         ㅏ TestMiddleware@handle
	 *
	 * @param mixed  $node  Node middleware cần định dạng (Closure, string, mảng
	 *                      lá [class, method], hoặc block có key 'relation').
	 * @param int    $depth Độ sâu hiện tại của node trong cây middleware, dùng để
	 *                      tính mức thụt lề (mỗi cấp tương ứng 4 khoảng trắng).
	 * @param array  $lines Mảng chứa các dòng kết quả, được truyền theo tham chiếu
	 *                      để hàm ghi trực tiếp kết quả vào (bao gồm cả các dòng
	 *                      sinh ra từ lời gọi đệ quy).
	 *
	 * @return void
	 */
	protected function formatMiddlewareNode($node, int $depth, array &$lines): void {
		$indent = str_repeat('    ', $depth);

		// Closure lá.
		if ($node instanceof \Closure) {
			$lines[] = $indent.'ㅏ Closure';
			return;
		}

		// String middleware đơn.
		if (!is_array($node)) {
			$lines[] = $indent.'ㅏ '.class_basename((string)$node);
			return;
		}

		// Mảng: lá hoặc block.
		if ($this->isLeafMiddleware($node)) {
			$class = $node[0];
			if (str_contains($class, ':')) {
				// throttle:3rpm, throttle:60,1 ...
				$lines[] = $indent.'ㅏ '.class_basename($class);
			}
			else {
				$lines[] = $indent.'ㅏ '.class_basename($class).'@'.($node[1] ?? 'handle');
			}
			return;
		}

		// Block: in header relation rồi đệ quy các con.
		$relation = strtoupper($node['relation'] ?? 'AND');
		unset($node['relation']);

		$lines[] = $indent.'┌─ ['.$relation.']';
		foreach ($node as $child) {
			$this->formatMiddlewareNode($child, $depth + 1, $lines);
		}
	}

}