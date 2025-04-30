<?php

class Helper {

    public static function strContains(string $haystack, string $needle) : bool {
        return '' === $needle || false !== strpos($haystack, $needle);
    }

    public static function trimWWhitespace(string $input) : string {
        $input = preg_replace('/[^\S ]+/', '', $input);

        return trim($input);
    }

    public static function sanitize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[is_string($key) ? self::sanitize($key) : $key] = self::sanitize($value);
            }
        }

        if (is_string($data)) {
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }

}
