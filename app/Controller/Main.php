<?php

class Main_Controller extends Controller {

    public function main_action() : void {
        $this->response
            ->body('Hello, World!')
            ->send();
    }

}
