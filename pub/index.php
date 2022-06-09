<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\src\Application;

include_once "../routes/routes.php";

$app = new Application();

$app->run();
