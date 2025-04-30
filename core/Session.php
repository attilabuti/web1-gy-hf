<?php

class Session {

    public static function start() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function get(string $key, $default = null) {
        self::start();
        $data = Arr::get($_SESSION, $key, $default);

        return $data ?? $default;
    }

    public static function set($key, $value = null) : void {
        self::start();
        $_SESSION = Arr::set($_SESSION, $key, $value);
    }

    public static function delete($key) : void {
        self::start();
        $_SESSION = Arr::delete($_SESSION, $key);
    }

    public static function clear() : bool {
        self::start();
        return session_unset();
    }

    public static function destroy() : bool {
        self::start();
        return session_destroy();
    }

}
