<?php

class Config {

    protected static array $config = [];

    public static function get(string $key, $default = null)  {
        $segments = explode('.', $key);
        $file = array_shift($segments);

        if (!isset(self::$config[$file])) {
            $path = __DIR__ . '/../config/' . $file . '.php';
            if (!file_exists($path)) {
                return $default;
            }

            self::$config[$file] = require $path;
        }

        $value = self::$config[$file];

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }

            $value = $value[$segment];
        }

        return $value;
    }

}
