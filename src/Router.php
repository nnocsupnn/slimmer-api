<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Auth\Validator as Auth;

use \Exception as ErrException;

$skip_path = [
	'/get_token/{user}/{pass}'
];

foreach ($routes as $path => $class) {
	try {
		$app->get($path, function (Request $request, Response $response, $args) use ($class, $path, $skip_path) {		
			
			if (!in_array($path, $skip_path)) {
				$token = explode(" ", end($request->getHeaders()['HTTP_AUTHORIZATION']))[1];
				$isValidated = Auth::validateToken($token);
				if (is_string($isValidated)) return $response->withJson(['error' => ['1' => $isValidated]]); 
			}

			$instance = explode("@", $class);
			$method = $instance[1];
			$class = new $instance[0]($request);

			if (!method_exists($class, $method)) throw new ErrException("Method $method is not exists on routes", 1);
			
			return $class->{$method}($request, $response, $args);
		});

	} catch (ErrException $e) {
		die("Caugth Exception: " . $e->getMessage());
	}
}



