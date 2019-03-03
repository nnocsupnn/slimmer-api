<?php

require '../vendor/autoload.php';

# Load env vars
$env = '../.env';
if (file_exists($env)) (new Symfony\Component\Dotenv\Dotenv)->load($env);

# Set Database
$config = loadDb();
(new \App\Database($config));

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


# Head - Router
$routes = require '../src/routes.php';
require  '../src/Router.php';
# End - Router


$app->run();