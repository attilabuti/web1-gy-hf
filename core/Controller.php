<?php

abstract class Controller {

    protected Request  $request;
    protected Response $response;
    protected Auth     $auth;

    public function __construct() {
        $this->request  = new Request();
        $this->response = new Response();
        $this->auth     = new Auth();
    }

}
