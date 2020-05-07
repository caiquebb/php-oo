<?php

namespace Code\Security\Validator;

class Validator
{
    public static function validateRequiredFields(array $data) : bool
    {
        foreach ($data as $key => $value) {
            if (is_null($data[$key])) {
                return false;
            }
        }

        return true;
    }

    public static function validatePasswordConfirm($password, $passwordConfirm) : bool
    {
        return $password == $passwordConfirm;
    }

    public static function validatePasswordMinLength($password) : bool
    {
        return strlen($password) >= 6;
    }
}
