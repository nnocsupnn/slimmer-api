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
		'skip' => false
	],

	'/sample' => [
		'class' => 'App\Controllers\RouteMethods@index',
		'method' => 'get',
		'skip' => false
	],

	'/request_token' => [
		'class' => 'App\Controllers\RouteMethods@getToken',
		'method' => 'post',
		'skip' => true
	]
];
