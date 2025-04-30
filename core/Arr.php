<?php

class Arr {

    public static function get($data, string $key, $default = null) {
        if ($data === null || !is_array($data) || $data === []) {
            return $default;
        }

        if ($key === null || strlen($key) === 0) {
            return $default;
        }

        $segments = explode('.', $key);

        foreach ($segments as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                return $default;
            }

            $data = $data[$segment];
        }

        return $data;
    }

    public static function set($data, string $key, $value = null) : array {
        if ($data === null || !is_array($data) || $data === []) {
            $data = [];
        }

        if ($key === null || strlen($key) === 0)  {
            return $data;
        }

        $segments = explode('.', $key);
        $current = &$data;

        for ($i = 0; $i < count($segments) - 1; $i++) {
            $segment = $segments[$i];

            if (!isset($current[$segment]) || !is_array($current[$segment])) {
                $current[$segment] = [];
            }

            $current = &$current[$segment];
        }

        $lastSegment = end($segments);
        $current[$lastSegment] = $value;

        return $data;
    }

    public static function delete($data, string $key) : array {
        if ($data === null || !is_array($data) || $data === []) {
            return [];
        }

        if ($key === null || strlen($key) === 0) {
            return $data;
        }

        $segments = explode('.', $key);
        $current = &$data;

        for ($i = 0; $i < count($segments) - 1; $i++) {
            $segment = $segments[$i];

            if (!isset($current[$segment]) || !is_array($current[$segment])) {
                return $data;
            }

            $current = &$current[$segment];
        }

        $lastSegment = end($segments);

        if (is_array($current) && array_key_exists($lastSegment, $current)) {
            unset($current[$lastSegment]);
        }

        return $data;
    }

}
