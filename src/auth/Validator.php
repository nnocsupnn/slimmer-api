<?php

namespace App\Auth;

use App\Auth\JWT;

use Illuminate\Database\Capsule\Manager as DB;

/**
* All validating functions for the user
*/
class Validator {

	public static function validateToken($token) {
		try {
			$validated = JWT::decode(trim($token), APP_KEY, [KEY_ALG]);
			return true;
		} catch (\UnexpectedValueException $e) {
			return $e->getMessage();
		}
	}


	public static function validateUser($args) {
		$data = DB::table(API_USER_TABLE)->where($args)->limit(1)->value('active');
		if ($data == "yes") {
			return true;
		} else {
			return false;
		}
	}

	public static function generateToken($request, $response, $args) {
		if (count($args) <= 1) {
			return $response->withJson(errorMessages(5));
		}

		$minutes = (60 * 5);

		# JWT Prerequired data
		$args['iat'] = time();
		$args['iss'] = 'localhost';
		$args['exp'] = time() + (60 * 5);
		
		$jwt_token = JWT::encode($args, APP_KEY);

		$duration = $minutes / 60;
		return $response->withJson([
			'response' => [
				'duration' => "{$duration} minute(s)",
				'token' => $jwt_token
			]
		]);
	}
}