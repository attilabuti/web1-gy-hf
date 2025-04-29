<?php

class Arr {

    public static function get($data, $item = null, $default = null) {
        if (!$item) {
            return $default;
        }

        $segments = explode('.', $item);

        foreach ($segments as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                return $default;
            }

            $data = $data[$segment];
        }

        return $data;
    }

}
