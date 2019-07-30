<?php

namespace App\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface ValidatorInterface {
    public static function validateToken($args = '');
    public static function validateUser($args = []);
    public static function generateToken(Request $request, Response $response, $args = []);
}