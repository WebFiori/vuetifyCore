<?php

use WebFiori\Framework\App;

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$DS = DIRECTORY_SEPARATOR;
$testsDirName = 'tests';
$rootDir = substr(__DIR__, 0, strlen(__DIR__) - strlen($testsDirName));

define('ROOT_PATH', $rootDir);
define('DS', $DS);
define ('APP_DIR', 'App');
define('APP_PATH', ROOT_PATH .DS. APP_DIR . $DS);
require_once __DIR__ . $DS . '..' . $DS . 'vendor' . $DS . 'autoload.php';
fprintf(STDOUT, "Running tests...\n");