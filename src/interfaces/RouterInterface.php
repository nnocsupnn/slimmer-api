<?php

namespace App\Interfaces;

use \Slim\App;

interface RouterInterface {
    public function load(App $app);
}