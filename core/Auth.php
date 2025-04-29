<?php

class Auth {

    private ?array $user = null;

    public function __construct() {
        if (isset($_SESSION['auth_user']) && !empty($_SESSION['auth_user']) && is_array($_SESSION['auth_user'])) {
            $this->user = $_SESSION['auth_user'];
        }
    }

    public function login(int $userId, array $data = []) : void {
        $this->user = [
            'user_id' => $userId,
            'data'    => $data,
        ];

        $_SESSION['auth_user'] = $this->user;
    }

    public function logout() : void {
        unset($_SESSION['auth_user']);
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
