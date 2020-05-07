<?php

namespace Code\Session;

class Flash
{
    public static function add($key, $message)
    {
        Session::add($key, $message);
    }

    public function get($key)
    {
        $msg = Session::get($key);

        Session::remove($key);

        return $msg;
    }
}