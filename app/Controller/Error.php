<?php

class Error_Controller extends Controller {

    public function error404_action() : void {
        $this->response
            ->setStatusCode(404)
            ->markup(View::render('error/404'))
            ->send();
    }

}
