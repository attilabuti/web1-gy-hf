<?php

class Helper {

    public static function strContains(string $haystack, string $needle) : bool {
        return '' === $needle || false !== strpos($haystack, $needle);
    }

    public static function trimWWhitespace(string $input) : string {
        $input = preg_replace('/[^\S ]+/', '', $input);

        return trim($input);
    }

}
