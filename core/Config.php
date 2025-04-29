<?php

class Config {

    protected static array $config = [];

    public static function get(string $key, $default = null)  {
        $segments = explode('.', $key);
        $file = array_shift($segments);

        if (!isset(self::$config[$file])) {
            $path = Path::join(Path::base(), 'config', $file . '.php');
            if (!file_exists($path)) {
                return $default;
            }

            self::$config[$file] = require $path;
        }

        return Arr::get(self::$config[$file], implode('.', $segments));
    }

}
