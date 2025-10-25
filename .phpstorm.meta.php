<?php

namespace PHPSTORM_META {
	override(\WPSP\Funcs::route(1), map([
		'wpsp.api-token.get' => '@\\WPSP\\Apis',
	]));
	override(\wpsp_route(1), map([
		'wpsp.api-token.get' => '@\\WPSP\\Apis',
	]));
}
