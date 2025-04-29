<?php

class Main_Controller extends Controller {

    public function main_action() : void {
        $this->response->markup(
            View::render('main', [
                'name' => 'World',
            ])
        )->send();

        // $this->response
        //     ->plain('Hello, World!')
        //     ->send();
    }

}
