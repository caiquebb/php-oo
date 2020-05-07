<?php

namespace Code\Authenticator;

use Code\Session\Session;

trait CheckUser
{
    public function check()
    {
        if (Session::has('user')) {
            return true;
        }

        return false;
    }
}
