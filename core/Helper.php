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

    public static function slugify($text) : string {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        $text = trim($text, '-');

        return $text;
    }

    public static function createUniqueSlug($text, $maxLength = 255) {
        $unique = str_replace('.', '', uniqid('-', true));
        $uniqueLength = strlen($unique);

        $textMax = $maxLength - $uniqueLength;
        if (strlen($text) > $textMax) {
            $text = substr($text, 0, $textMax);
        }

        return $text . $unique;
    }

}
