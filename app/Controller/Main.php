<?php

class Main_Controller extends Controller {

    public function main_action() : void {
        $this->response->markup(
            View::render('main', [
                'name' => $this->auth->isLoggedIn() ? $this->auth->getData('name') : 'World',
            ])
        )->send();
    }

}
