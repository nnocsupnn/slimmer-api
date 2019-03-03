<?php


use App\Auth\JWT;


function getKey() {
	return getenv('APP_KEY');
}

function loadDb() {
	return [
		'driver'    => getenv("DB_DRIVER"),
		'host'      => getenv("DB_HOST"),
		'database'  => getenv("DB_NAME"),
		'username'  => getenv("DB_USER"),
		'password'  => getenv("DB_PASS"),
		'charset'   => getenv("DB_CHARSET"),
		'collation' => getenv("DB_COLLATION"),
		'prefix'    => getenv("DB_PREFIX")
	];
}