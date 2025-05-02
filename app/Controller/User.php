<?php

class User_Controller extends Controller {

    public function registration_action() : void {
        if ($this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $this->response->markup(
            View::render('registration')
        )->send();
    }

    public function registration_post_action() : void {
        if ($this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $postData = $_POST;

        $postData['username']   = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'username', '')));
        $postData['last_name']  = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'last_name', '')));
        $postData['first_name'] = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'first_name', '')));

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
            'name'  => 'password_re',
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

        $users = new Users_Model();

        if ($users->isEmailTaken(Arr::get($postData, 'email'))) {
            Flash::set('A megadott e-mail címmel már regisztráltak.', 'error');
            $this->response->redirect('/regisztracio');
        }

        if ($users->isUsernameTaken(Arr::get($postData, 'username'))) {
            Flash::set('A megadott felhasználónév már foglalt.', 'error');
            $this->response->redirect('/regisztracio');
        }

        $pwdHash = password_hash(Arr::get($postData, 'password'), PASSWORD_ARGON2ID);

        $users->register(
            Arr::get($postData, 'email'),
            Arr::get($postData, 'username'),
            $pwdHash,
            Arr::get($postData, 'first_name'),
            Arr::get($postData, 'last_name'),
        );

        Flash::set('Sikeres regisztráció!', 'message');
        $this->response->redirect('/bejelentkezes');
    }

    public function login_action() : void {
        if ($this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $this->response->markup(
            View::render('login')
        )->send();
    }

    public function login_post_action() : void {
        if ($this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $result = Valid::check($_POST, [[
            'name' => 'email',
            'rules' => [
                'required' => 'Az e-mail cím megadása kötelező.',
                'is:mail'  => 'Érvényes e-mail cím megadása kötelező.',
            ],
        ], [
            'name'  => 'password',
            'rules' => [
                'required' => 'A jelszó megadása kötelező.',
            ],
        ]]);

        if ($result !== null) {
            Flash::set($result, 'error');
            $this->response->redirect('/bejelentkezes');
        }

        $users = new Users_Model();

        $pwdHash = $users->getUserHash($this->request->post('email'));
        if ($pwdHash === null) {
            Flash::set('Hibás e-mail cím vagy jelszó!', 'error');
            $this->response->redirect('/bejelentkezes');
        }

        if (password_verify($this->request->post('password'), $pwdHash)) {
            $userInfo = $users->getUserInfo($this->request->post('email'));
            $this->auth->login($userInfo['id'], [
                'name'     => $userInfo['last_name'] . ' ' . $userInfo['first_name'],
                'username' => $userInfo['username'],
            ]);

            $this->response->redirect('/');
        } else {
            Flash::set('Hibás e-mail cím vagy jelszó!', 'error');
            $this->response->redirect('/bejelentkezes');
        }
    }

    public function logout_action() : void {
        $this->auth->guard('/');
        $this->auth->logout();
        $this->response->redirect('/');
    }

}
