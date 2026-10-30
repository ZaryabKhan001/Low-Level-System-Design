<?php

class BankAccount
{
    protected float $balance;

    public function __construct(float $balance)
    {
        if ($balance < 0) {
            throw new InvalidArgumentException("Balance can't be negative");
        }

        $this->balance = $balance;
    }

    // History constraint: withdraw should be allowed.
    public function withdraw(float $amount): void
    {
        if ($this->balance - $amount < 0) {
            throw new RuntimeException("Insufficient funds");
        }

        $this->balance -= $amount;

        echo "Amount withdrawn. Remaining balance is {$this->balance}\n";
    }
}

class FixedDepositAccount extends BankAccount
{

    public function __construct(float $balance)
    {
        parent::__construct($balance);
    }

    // LSP violation: Parent allows withdrawal, but child doesn't.
    public function withdraw(float $amount): void
    {
        throw new RuntimeException("Withdraw not allowed in Fixed Deposit");
    }
}

// Main
$bankAccount = new BankAccount(100);
$bankAccount->withdraw(100);

// Try this:
// $fixedAccount = new FixedDepositAccount(100);
// $fixedAccount->withdraw(50);
