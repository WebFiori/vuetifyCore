<?php

use WebFiori\Framework\App;

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['SERVER_PORT'] = '80';
$_SERVER['SCRIPT_NAME'] = '/index.php';

$DS = DIRECTORY_SEPARATOR;
$testsDirName = 'tests';
$rootDir = substr(__DIR__, 0, strlen(__DIR__) - strlen($testsDirName));

define('ROOT_PATH', $rootDir);
define('DS', $DS);
define ('APP_DIR', 'App');
define('APP_PATH', ROOT_PATH .DS. APP_DIR . $DS);
define('TESTING', true);

require_once __DIR__ . $DS . '..' . $DS . 'vendor' . $DS . 'autoload.php';

// Register App namespace for test language classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strpos($class, $prefix) === 0) {
        $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, strlen($prefix)));
        $file = ROOT_PATH . 'App' . DIRECTORY_SEPARATOR . $relative . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Initialize framework enough for tests
WebFiori\Framework\App::initiate('App', 'public', ROOT_PATH . 'public');
App::start();

fprintf(STDOUT, "Running tests...\n");
