<?php

namespace Code;

use Code\Exceptions\MyCustomException;
use InvalidArgumentException;

class Sum
{
    public function doSum($n1, $n2)
    {
        if ($n2 > 10) {
            // throw new InvalidArgumentException("Parametro 2 deve ser menor ou igual a 10");
            throw new MyCustomException("Teste");
        }

        return $n1 + $n2;
    }
}
