<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Auth\Validator as Auth;

use \Exception as ErrException;

$skip_path = [
	'/request_token/{username}/{password}'
];

foreach ($routes as $path => $route) {
	try {
		$app->{$route['method']}($path, function (Request $request, Response $response, $args) use ($route, $path, $skip_path) {		
			
			# Checking and validation
			if (in_array($path, $skip_path)) {
				# requesting token using username and password
				$auth = Auth::validateUser($args);
				if (!$auth) return $response->withJson(errorMessages(03));
				
			} else {
				# if token is available in the bearer
				$header_token = @$request->getHeaders()['HTTP_AUTHORIZATION'];
				if (empty($header_token)) return $response->withJson(errorMessages(02)); 

				$token = explode(" ", end($header_token))[1];
				$isValidated = Auth::validateToken($token);

				if (is_string($isValidated)) return $response->withJson(['error' => [
					'code' => 0,
					'message' => $isValidated
				]]); 
			}
			# End validation and checking

			# Disect routes - class, method from $route['class']
			$instance = explode("@", $route['class']);
			$method = $instance[1]; // Method
			$class = new $instance[0]($request); // Class

			if (!method_exists($class, $method)) throw new ErrException("Method $method is not exists on routes", 1);
			
			return $class->{$method}($request, $response, $args);
		});

	} catch (ErrException $e) {
		die("Caugth Exception: " . $e->getMessage());
	}
}



