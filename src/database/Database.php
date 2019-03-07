<?php

namespace App;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database {

	private $database;
	private $config;

	public function __construct(array $config, $conection = 'default')
	{
		$this->config['config'] = $config;
		$this->config['connection'] = $conection;
	    $this->database = new Manager;   
	}

	public function load() {
		$this->database->addConnection($this->config['config'], $this->config['connection']);

	    $this->database->setEventDispatcher(new Dispatcher(new Container));
	    $this->database->setAsGlobal();
	    $this->database->bootEloquent();
	}
}
