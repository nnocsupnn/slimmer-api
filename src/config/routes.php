<?php

/**
* @return $routes 
* Define all your routes here.
* @var Class @ method
* @var skip is for special routes
*/

return [
	'/' => [
		'class' => 'App\Controllers\RouteMethods@default',
		'method' => 'get',
		'skip' => true
	],

	'/sample' => [
		'class' => 'App\Controllers\RouteMethods@index',
		'method' => 'get',
		'skip' => true
	],

	'/request_token' => [
		'class' => 'App\Controllers\RouteMethods@getToken',
		'method' => 'post',
		'skip' => false
	]
];
