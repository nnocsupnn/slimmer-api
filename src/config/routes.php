<?php

/**
* @return $routes 
* Define all your routes here.
* @var Class @ method
* @var skip  false is for special routes
*/

$routes = [
	'/' => [
		'class' => 'App\Controllers\Controllers@default',
		'method' => 'get',
		'skip' => true
	],

	'/sample' => [
		'class' => 'App\Controllers\Controllers@index',
		'method' => 'get',
		'skip' => true
	],

	URI_TOKEN => [
		'class' => 'App\Controllers\Controllers@getToken',
		'method' => 'post',
		'skip' => false
	]
];
