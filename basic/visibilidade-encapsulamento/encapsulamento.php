<?php

class BankAccount
{
    private $balance = 0;

    public function __construct()
    {
        $this->balance = 30;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function deposit($money)
    {
        $this->balance += $money;
    }

    public function withdraw($money)
    {
        if ($money > $this->balance) {
            return false;
        }

        $this->balance -= $money;
    }
}

$account = new BankAccount;

$account->deposit(10);
$account->deposit(20);

print $account->getBalance();

print "\n";
