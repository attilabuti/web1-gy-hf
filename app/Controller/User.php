<?php

class User_Controller extends Controller {

    public function registration_action() : void {
        echo 'Regisztráció';
        exit;
    }

    public function login_action() : void {
        $this->auth->guard('/');
        echo 'Bejelentkezés';
        exit;
    }

    public function logout_action() : void {
        echo 'Kijelentkezés';
        exit;
    }

}
