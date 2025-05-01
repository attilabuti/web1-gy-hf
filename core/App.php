<?php

class App {

    protected static array $services = [];

    public static function bind(string $key, $instance) : void {
        self::$services[$key] = $instance;
    }

    public static function get(string $key) {
        if (!isset(self::$services[$key])) {
            throw new Exception("Service '$key' not found.");
        }

        return self::$services[$key];
    }

}
