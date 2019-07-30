<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Auth\Validator as Auth;

use \Exception as ErrException;
use App\HTTP;
use App\Interfaces\RouterInterface;

class Router extends HTTP implements RouterInterface {
	private $routes;

	function __construct($routes) {
		$this->routes = $routes;
	}

	public function load($app) {
		foreach ($this->routes as $path => $route) {
			try {
				# Map routes
				$app->{$route['method']}($path, function (Request $request, Response $response, $args) use ($route, $path) {		
					# Checking and validation
					if ($path == URI_TOKEN) {
						# requesting token using username and password
						@$post_data = $request->getParsedBody();
						$auth = Auth::validateUser($post_data);
						if (!$auth) return $response->withJson(error(3), HTTP_MOVED_PERMANENTLY);
						
					} else {
						# if token is available in the bearer
						$header_token = @$request->getHeaders()['HTTP_AUTHORIZATION'];
						$this->is_validUser($header_token, $response);
					}
					# End validation and checking

					$this->is_callable($route, $request);
					

					if (!method_exists($class, $method)) throw new ErrException("Method $method is not exists on routes", 1);
					if (count($args) <= 0) $args = @$post_data;
					
					return $class->{$method}($request, $response, $args);
				});

			} catch (ErrException $e) {
				die("Caugth Exception: " . $e->getMessage());
			}
		}
	}

	protected function is_callable($route, Request $request) {
		# Disect routes - class, method from $route['class']
		$instance = explode("@", $route['class']);
		$method = $instance[1]; // Method
		$class = new $instance[0]($request); // Class
	}


	private function is_validUser($header_token, Response $response) {
		if (empty($header_token)) {
			return $response->withJson(error(2)); 
		}
		
		$token = explode(" ", end($header_token))[1];
		$isValidated = Auth::validateToken($token);
		
		if (!$isValidated['validated']) {
			return $response->withJson(['error' => [
				'code' => 0,
				'message' => $isValidated['message']
			]]); 
		}
	}
}

