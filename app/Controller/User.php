<?php

class User_Controller extends Controller {

    public function registration_action() : void {
        $this->response->markup(
            View::render('registration')
        )->send();
    }

    public function registration_post_action() : void {
        $postData = $_POST;
        $postData['username']   = Helper::trimWWhitespace(Arr::get($postData, 'username', ''));
        $postData['last_name']  = Helper::trimWWhitespace(Arr::get($postData, 'last_name', ''));
        $postData['first_name'] = Helper::trimWWhitespace(Arr::get($postData, 'first_name', ''));

        $result = Valid::check($postData, [[
            'name'  => 'username',
            'rules' => [
                'required' => 'A felhasználónév megadása kötelező.',
                'min:4'    => 'A felhasználónév legalább $$ karakter hosszúnak kell lennie.',
                'max:20'   => 'A felhasználónév maximum $$ karakter hosszú lehet.',
            ],
        ], [
            'name' => 'email',
            'rules' => [
                'required' => 'Az e-mail cím megadása kötelező.',
                'is:mail'  => 'Érvényes e-mail cím megadása kötelező.',
            ],
        ], [
            'name'  => 'password',
            'rules' => [
                'required' => 'A jelszó megadása kötelező.',
                'min:5'    => 'A jelszónak legalább $$ karakter hosszúnak kell lennie.',
            ],
        ], [
            'name'  => 'password-re',
            'rules' => [
                'equal:password' => 'A két jelszónak meg kell egyeznie.'
            ],
        ], [
            'name'  => 'last_name',
            'rules' => [
                'required' => 'A családnév megadása kötelező.',
                'max:50'   => 'A családnév maximum $$ karakter hosszú lehet.',
            ],
        ], [
            'name'  => 'first_name',
            'rules' => [
                'required' => 'Az utónév megadása kötelező.',
                'max:50'   => 'Az utónév maximum $$ karakter hosszú lehet.',
            ],
        ]]);

        if ($result !== null) {
            Flash::set($result, 'error');
            $this->response->redirect('/regisztracio');
        }


        // $users = new Users_Model();
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
