<?php

class Valid {

    public static function check(array $data, array $rules) {
        foreach ($rules as $rule) {
            $input = Arr::get($data,  $rule['name']);

            $ruleSet = Arr::get($rule, 'rules');
            if ($ruleSet !== null) {
                foreach ($ruleSet as $r => $err) {
                    if ($r == 'required' && ($input === null || strlen($input) === 0)) {
                        return $err;
                    } else if (Helper::strContains($r, 'min:')) {
                        $length = (int) str_replace('min:', '', $r);

                        if ($input === null || strlen($input) < $length) {
                            return str_replace('$$', $length, $err);
                        }
                    } else if (Helper::strContains($r, 'max:')) {
                        $length = (int) str_replace('max:', '', $r);

                        if ($input !== null && strlen($input) > $length) {
                            return str_replace('$$', $length, $err);
                        }
                    } else if (Helper::strContains($r, 'is:')) {
                        $ruleType = str_replace('is:', '', $r);

                        if ($input === null) {
                            return $err;
                        } else if ($ruleType == 'mail') {
                            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                                return $err;
                            }
                        }
                    } else if (Helper::strContains($r, 'equal:')) {
                        $equalWith = str_replace('equal:', '', $r);
                        $inputEual = Arr::get($data, $equalWith);

                        if ($inputEual === null) {
                            return $err;
                        } else if ($input != $inputEual) {
                            return $err;
                        }
                    }
                }
            }
        }

        return null;
    }

}
