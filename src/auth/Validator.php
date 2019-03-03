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
		$data = DB::table('users')->where($args)->limit(1)->value('active');
		if ($data == "yes") {
			return true;
		} else {
			return false;
		}
	}
}