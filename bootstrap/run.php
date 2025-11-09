<?php

use WPSP\bootstrap\Application;
use WPSP\Funcs;

require_once __DIR__ . '/../vendor/autoload.php';

$app   = Application::init();
$funcs = Funcs::init();

require_once __DIR__ . '/routes.php';