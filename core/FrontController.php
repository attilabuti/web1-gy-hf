<?php

class FrontController {
    const CONTROLLER_DIR     = __DIR__ . '/app/Controller/';
    const DEFAULT_ACTION     = 'main';
    const DEFAULT_CONTROLLER = 'main';
    const BASE_PATH = '';

    protected string $controller = self::DEFAULT_CONTROLLER;
    protected string $action     = self::DEFAULT_ACTION;
    protected array  $params     = array();

    public function __construct() {
        $this->parseUri();
    }

    protected function parseUri() : void {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if ($path === self::BASE_PATH) {
        	$this->setController($this->controller);
        	$this->setAction($this->action);
        } else {
			if (self::BASE_PATH != '') {
				$path = trim(str_replace(self::BASE_PATH, '', $path), '/');
			}

        	@list($controller, $action, $params) = explode('/', $path, 3);
        	if (isset($controller)) {
        	    $this->setController($controller);
        	}

        	if (isset($action)) {
        	    $this->setAction($action);
        	}

        	if (isset($params)) {
        	    $this->setParams(explode('/', $params));
        	}
        }
    }

    public function setController(string $controller) : void {
        $controller = ucfirst(strtolower($controller)) . '_Controller';

        if (!class_exists($controller, true)) {
            call_user_func_array(array(new Error_Controller, 'error404_action'), []);

        	exit;
    	}

        $this->controller = $controller;
    }

    public function setAction(string $action) : void {
        $action = strtolower($action) . '_action';

        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            call_user_func_array(array(new Error_Controller, 'error404_action'), []);
            exit;
    	}

        $this->action = $action;
    }

    public function setParams(array $params) : void {
        $this->params = $params;
    }

    public function run() : void {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}
