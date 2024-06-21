<?php

namespace WPSP\app\Components\License;

use WPSPCORE\Objects\Cache\Cache;
use Symfony\Component\HttpClient\HttpClient;

class License {

	public static function getLicense() {
		$settings = Cache::getItemValue(config('app.short_name') . '_settings');
		return $settings['license_key'] ?? null;
	}

	public static function checkLicense(string $license = null, $reCheck = false): array {
		if ($license) {
			if ($reCheck) {
				Cache::delete(config('app.short_name') . '_license_information');
			}
			$data = Cache::get(config('app.short_name') . '_license_information', function() use ($license) {
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
			$data = _response(true, $data, 'License key is checked', 200);
		}
		else {
			$data = _response(false, null, 'License key is empty', 400);
		}
		return $data;
	}

}