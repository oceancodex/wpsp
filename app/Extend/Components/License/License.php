<?php

namespace WPSP\app\Extend\Components\License;

use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Models\SettingsModel;
use WPSP\Funcs;
use WPSPCORE\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class License {

	public static function getLicense() {
		try {
			$settings = SettingsModel::query()->where('key','settings')->first();
			$settings = json_decode($settings['value'] ?? '', true);
		}
		catch (\Exception $e) {}
		return $settings['license_key'] ?? null;
	}

	public static function checkLicense($reCheck = false): array {
		try {
			$license = self::getLicense();
			if ($license) {
				if ($reCheck) {
					Cache::delete('license_information');
				}
				$data = Cache::get('license_information', function(ItemInterface $item) use ($license) {
					$response = HttpClient::create()->request('POST', 'https://domain.com/api/license/check', [
						'headers' => [
							'Content-Type' => 'application/json',
							'Accept'       => 'application/json',
							'Verify'       => false,
						],
						'body'    => json_encode([
							'license_key' => $license,
							'domain'      => parse_url(site_url(), 1),
						]),
					])->getContent();
					$response = json_decode($response, true);
					return $response['data'] ?? null;
				});
				$data = Funcs::response(true, $data, 'License key is checked', 200);
			}
			else {
				$data = Funcs::response(false, null, 'License key is empty', 400);
			}
		}
		catch (\Exception|\Throwable $e) {
			$data = Funcs::response(false, null, $e->getMessage(), 500);
		}
		return $data;
	}

}