<?php

class FrontController {

    protected string $controller;
    protected string $action;
    protected bool   $hasBefore = false;

    public function __construct() {
        $this->parseUri();
    }

    protected function normalizeUri(string $uri) : string {
        $path = trim(preg_replace('/[\/\\\\]+/', '/', strtolower($uri)));

        if (strlen($path) === 0) {
            $path = '/';
        }

        $path = ($path[0] !== '/') ? '/' . $path : $path;

        return rtrim($path, '/');
    }

    protected function parseUri() : void {
        $path = $this->normalizeUri($_SERVER['REQUEST_URI'], true);

        $basePath = $this->normalizeUri(Config::get('app.basePath', ''));
        if (strlen($basePath) !== 0 && $basePath !== '/') {
            $path = $this->normalizeUri(substr($path, strlen($basePath)));
        }

        $routes = require Path::join(Path::base(), 'app', 'routes' . '.php');

        $routeFound = false;
        foreach ($routes as $route => $options) {
            if ($this->normalizeUri($route) === $path) {
                if (!isset($options['controller']) || empty($options['controller'])) {
                    $this->setController('main');
                } else {
                    $this->setController($options['controller']);
                }

                if (!isset($options['action']) || empty($options['action'])) {
                    $this->setAction('main');
                } else {
                    $this->setAction($options['action']);
                }

                $routeFound = true;

                break;
            }
        }

        if (!$routeFound) {
            $this->callError();
            exit;
        }
    }

    public function setController(string $controller) : void {
        $controller = ucfirst(strtolower($controller)) . '_Controller';

        if (!class_exists($controller, true)) {
            $this->callError();
            exit;
        }

        $this->controller = $controller;
    }

    public function setAction(string $action) : void {
        $action = strtolower($action);
        $reflector = new \ReflectionClass($this->controller);


        if ($reflector->hasMethod('_before')) {
            $this->hasBefore = true;
        }

        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $postAction = "{$action}_post_action";

            if ($reflector->hasMethod($postAction)) {
                $this->action = $postAction;
                return;
            }
        }

        $getAction = "{$action}_action";
        if (!$reflector->hasMethod($getAction)) {
            $this->callError();
            exit;
        }

        $this->action = $getAction;
    }

    public function callError() : void {
        $this->controller = 'Error_Controller';
        $this->action     = 'error404_action';
        $this->hasBefore  = false;

        $this->run();
    }

    public function run() : void {
        $controller = new $this->controller;

        if ($this->hasBefore) {
            $controller->_before();
        }

        call_user_func_array(array($controller, $this->action), []);
    }

}
