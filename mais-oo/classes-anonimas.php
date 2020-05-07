<?php

// $classeAnonima = new class{
//     public function log($message)
//     {
//         return $message;
//     }
// };

class BankAccount
{
    public function withdraw($value, $classeAnonima)
    {
        return $classeAnonima->log('Logging withdraw...');
    }
}

$acc = new BankAccount;
print $acc->withdraw(19, new class{
    public function log($message)
    {
        return $message;
    }
});
