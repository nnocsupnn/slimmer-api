<?php

namespace App\Controllers;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use App\Auth\JWT;

class RouteMethods {

	public function default($request, $response, $args) {
		return $response->withJson([
			'data' => ['name' => 'onin', 'last_name' => 'casupanan']
		]);
	}

	public function index($request, $response, $args) {
		return $response->withJson([
			'data' => ['Error' => 'Message not supported.']
		]);
	}

	public function getToken($request, $response, $args) {
		
		if (count($args) <= 1) {
			exit;
		}

		$args['iat'] = time();
		$args['iss'] = 'localhost';
		$args['exp'] = time() + (60);
		
		$key = getKey();
		$jwt_token = JWT::encode($args, $key);

		return $response->withJson([
			'response' => ['token' => $jwt_token ]
		]);
	}
}