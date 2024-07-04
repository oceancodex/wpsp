<?php

namespace WPSP\app\Extend\Components\License;

use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\Funcs;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class License {

	public static function getLicense() {
		$settings = Cache::getItemValue('settings');
		return $settings['license_key'] ?? null;
	}

	public static function checkLicense(string $license = null, $reCheck = false): array {
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
		return $data;
	}

}