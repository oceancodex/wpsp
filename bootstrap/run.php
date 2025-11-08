<?php

use WPSP\bootstrap\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = Application::init();

require_once __DIR__ . '/routes.php';