<?php

class Auth {

    private ?array $user = null;

    public function __construct() {
        $this->user = Session::get('auth_user', null) ?? null;
    }

    public function login(int $userId, array $data = []) : void {
        $this->user = [
            'user_id' => $userId,
            'data'    => $data,
        ];

        Session::set('auth_user', $this->user);
    }

    public function logout() : void {
        Session::delete('auth_user');
        $this->user = null;
    }

    public function isLoggedIn() : bool {
        return $this->user !== null;
    }

    public function guard(string $url, int $statusCode = 302) : void {
        if (!$this->isLoggedIn()) {
            http_response_code($statusCode);
            header('Location: ' . $url);

            exit;
        }
    }

    public function getUserId() : ?int {
        if ($this->user !== null) {
            return $this->user['user_id'];
        }

        return null;
    }

    public function user() : ?array {
        if ($this->user !== null) {
            return $this->user['data'];
        }

        return null;
    }

    public function getData(string $key, $default = null) {
        return Arr::get($this->user['data'], $key, $default);
    }

}
