<?php

class User_Controller extends Controller {

    public function _before() {
        echo 'Before... ';
    }

    public function registration_post_action() : void {
        echo 'Regisztráció - POST';
        exit;
    }

    public function registration_action() : void {
        echo 'Regisztráció - GET';
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
