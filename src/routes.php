<?php

$routes = [
	'/' => 'App\Controllers\RouteMethods@default',
	'/sample' => 'App\Controllers\RouteMethods@index',
	'/get_token/{user}/{pass}' => 'App\Controllers\RouteMethods@getToken'
];


return $routes;