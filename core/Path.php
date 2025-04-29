<?php

class Path {

    public static function base() : string {
        return ROOT;
    }

    public static function join(...$parts) : string {
        if (sizeof($parts) === 0) {
            return '';
        }

        $prefix = ($parts[0] === DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR : '';

        $processed = array_filter(array_map(function($part) {
            return rtrim($part, DIRECTORY_SEPARATOR);
        }, $parts), function($part) {
            return !empty($part);
        });

        return $prefix . implode(DIRECTORY_SEPARATOR, $processed);
    }

}
