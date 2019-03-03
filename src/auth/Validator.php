<?php

namespace App\Auth;

use App\Auth\JWT;

use Illuminate\Database\Capsule\Manager as DB;


class Validator {

	public static function validateToken($token) {
		try {
			
			$key = getKey();
			$validated = JWT::decode($token, $key, array('HS256'));
			return true;

		} catch (\UnexpectedValueException $e) {
			return $e->getMessage();
		}
	}
}