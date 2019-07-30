<?php

require '../vendor/autoload.php';

# Load env vars
loadEnv();

# Set Database
loadDb();

# Pre define vars
define('API_USER_TABLE', getenv('USER_TABLE'));
define('KEY_ALG', getenv('JWT_ALG'));
define('APP_KEY', getenv('APP_KEY'));
define('MINUTE', getenv('MIN'));
define('URI_TOKEN', getenv('REQUEST_TOKEN_URI'));
define('SETTINGS_SLIM', ['settings' => [
	'displayErrorDetails' => getenv('ERROR_DETAILS')
]]);

# initiate app
$app = new \Slim\App(SETTINGS_SLIM);

# Head - Router
require '../src/config/routes.php';
(new \App\Router($routes))->load($app);
# End - Router

# Run
$app->run();