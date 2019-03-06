<?php

namespace App;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database {

	private $database;

	public function __construct(array $config, $conection = 'default')
	{
	    $this->database = new Manager;
	    $this->database->addConnection($config, $conection);

	    $this->database->setEventDispatcher(new Dispatcher(new Container));
	    $this->database->setAsGlobal();
	    $this->database->bootEloquent();
	}
}