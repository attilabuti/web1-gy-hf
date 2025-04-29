<?php

class Autoloader {

    protected static array $dirs = ['core', 'app/Controller', 'app/Model'];

    static public function loader(string $className) : void {
        $className = substr($className, strrpos($className, "\\"));
        $className = str_replace(['_Controller', '_Model'], '', $className);

        foreach (self::$dirs as $dir) {
            $file = $dir . '/' . ucfirst($className) . '.php';

            if (file_exists($file)) {
                require_once $file;
                break;
            }
        }
    }

}

spl_autoload_register('Autoloader::loader');
