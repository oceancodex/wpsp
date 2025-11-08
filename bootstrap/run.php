<?php

use WPSP\bootstrap\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = Application::init();

echo '<pre style="background:white;z-index:9999;position:relative">123123'; print_r($app); echo '</pre>'; die();

require_once __DIR__ . '/routes.php';