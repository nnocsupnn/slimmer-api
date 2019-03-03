<?php

namespace App;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database {

	public function __construct(array $config, $conection = 'default')
	{
	    $db = new Manager;
	    $db->addConnection($config, $conection);
	    $db->addConnection($config, $conection);

	    $db->setEventDispatcher(new Dispatcher(new Container));
	    $db->setAsGlobal();
	    $db->bootEloquent();
	}
}