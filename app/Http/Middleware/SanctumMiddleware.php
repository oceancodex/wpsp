<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class SanctumMiddleware {

	/**
	 * Middleware kiểm tra Bearer Token theo chuẩn Sanctum.
	 */
	public function handle($request, Closure $next, $args = []) {
		// Lấy Authorization header
		$authHeader = $request->header('Authorization');

		// Nếu không có Authorization hoặc không phải Bearer
		if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
			return $this->unauthorized('Thiếu Bearer Token trong header');
		}

		// Lấy phần token sau "Bearer "
		$plainTextToken = trim(substr($authHeader, 7));

		if (!$plainTextToken) {
			return $this->unauthorized('Bearer Token không hợp lệ');
		}

		/**
		 * TÌM TOKEN THEO CHUẨN SANCTUM
		 */
		$accessToken = PersonalAccessToken::findToken($plainTextToken);

		// Nếu token không tồn tại
		if (!$accessToken) {
			return $this->unauthorized('Token không hợp lệ');
		}

		// Kiểm tra hết hạn nếu token có expires_at
		if ($accessToken->expires_at && now()->greaterThan($accessToken->expires_at)) {
			return $this->unauthorized('Token đã hết hạn');
		}

		// Lấy user từ token
		$user = $accessToken->tokenable;

		if (!$user) {
			return $this->unauthorized('Không tìm thấy user của token');
		}

		/**
		 * CHECK ABILITIES (nếu route có truyền)
		 */
		if (!empty($args['abilities']) && ($abilities = $args['abilities'])) {
			$abilityRelation = strtolower($args['ability_relation'] ?? 'and');

			// Default result theo relation
			$passed = ($abilityRelation == 'or') ? false : true;
			$abilityCheck = null;

			foreach ($abilities as $ability) {
				$abilityCheck = $ability;
				$can = $accessToken->can($ability);
				if ($abilityRelation === 'and') {
					// AND → chỉ cần 1 cái fail là fail
					if (!$can) {
						$passed = false;
						break;
					}
				} else { // OR
					// OR → chỉ cần 1 cái pass là pass
					if ($can) {
						$passed = true;
						break;
					}
				}
			}

			if (!$passed) {
				return $this->unauthorized("Token không có quyền: {$abilityCheck}");
			}
		}

		// Cho phép đi tiếp vào controller
		return $next($request);
	}

	/**
	 * Response trả về khi không có quyền
	 */
	private function unauthorized(string $message) {
		return response()->json([
			'success' => false,
			'message' => $message,
		], Response::HTTP_UNAUTHORIZED);
	}

}
