<?php

class Error_Controller extends Controller {

    public function error404_action() : void {
        $this->response->setStatusCode(404);
        $this->response->body('<h1>404 - A keresett oldal nem található</h1>');
    }

}
