<?php

abstract class Controller {

    protected Response $response;

    public function __construct() {
        $this->response = new Response();
    }

    public function __destruct() {
        $this->response->send();
    }

}
