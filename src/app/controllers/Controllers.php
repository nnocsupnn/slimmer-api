<?php

namespace App\Controllers;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use App\Auth\JWT;
use App\Auth\Validator;
use App\HTTP;

class Controllers extends HTTP {

	public function default($request, $response, $args):object {
		return $response->withJson([
			'data' => [
				'name' => 'onin', 
				'last_name' => 'casupanan',
				'address' => [
					'current' => [
						'lot' => '360',
						'brgy' => '45',
						'province' => 'Pasay',
						'city' => 'Pasay'
					],
					'permanent' => [
						'lot' => '360',
						'brgy' => 'Abogado',
						'province' => 'Paniqui',
						'city' => 'Tarlac'
					]
				]
			]
					], HTTP::HTTP_OK);
	}

	public function index($request, $response, $args) {
		return $response->withJson([
			'data' => ['Error' => 'Message not supported.']
		]);
	}

	public function getToken($request, $response, $args) {
		return Validator::generateToken($request, $response, $args);
	}
}