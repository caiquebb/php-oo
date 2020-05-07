<?php

namespace Code\Security;

class PasswordHash
{
    public static function hash($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    public static function check($string, $stringHashed)
    {
        return password_verify($string, $stringHashed);
    }
}
