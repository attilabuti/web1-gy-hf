<?php

class Flash {

    public static function set(string $message, string $key = 'msg') : void {
        if (strlen($key) === 0) {
            $key = 'msg';
        }

        Session::set("flash.{$key}", $message);
    }

    public static function unset(string $key = 'msg') : void {
        if (strlen($key) === 0) {
            $key = 'msg';
        }

        Session::delete("flash.{$key}");
    }

    public static function get($key = 'msg') {
        if (strlen($key) === 0) {
            $key = 'msg';
        }

        $message = Session::get("flash.{$key}", null);
        if ($message !== null) {
            self::unset($key);
        }

        return $message;
    }

}
