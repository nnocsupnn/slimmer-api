<?php

/**
* @return $routes 
* Define all your routes here.
* @var Class @ method
*/

return [

	'/' => [
		'class' => 'App\Controllers\RouteMethods@default',
		'method' => 'get'
	],

	'/sample' => [
		'class' => 'App\Controllers\RouteMethods@index',
		'method' => 'get'
	],

	'/get_token/{username}/{password}' => [
		'class' => 'App\Controllers\RouteMethods@getToken',
		'method' => 'get'
	]
];
