<?php

namespace WPSP\App\WordPress\License;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use WPSP\App\Models\SettingsModel;
use WPSP\Funcs;

class License {

	public static function getLicense() {
		try {
			$settings = SettingsModel::query()->where('key','settings')->first();
			$settings = json_decode($settings['value'] ?? '', true);
		}
		catch (\Throwable $e) {}
		return $settings['license_key'] ?? null;
	}

	public static function checkLicense($reCheck = false): array {
		try {
			$license = self::getLicense();
			if ($license) {
				if ($reCheck) {
					Cache::delete('license_information');
				}
				$data = Cache::remember('license_information', 300, function() use ($license) {
					$response = Http::post('https://domain.com/api/license/check', [
						'headers' => [
							'Content-Type' => 'application/json',
							'Accept'       => 'application/json',
							'Verify'       => false,
						],
						'body'    => json_encode([
							'license_key' => $license,
							'domain'      => parse_url(site_url(), 1),
						]),
					])->getBody();
					$response = json_decode($response, true);
					return $response['data'] ?? null;
				});
				$data = Funcs::response(true, $data, 'License key is checked', 200);
			}
			else {
				$data = Funcs::response(false, null, 'License key is empty', 400);
			}
		}
		catch (\Throwable $e) {
			$data = Funcs::response(false, null, $e->getMessage(), 500);
		}
		return $data;
	}

}