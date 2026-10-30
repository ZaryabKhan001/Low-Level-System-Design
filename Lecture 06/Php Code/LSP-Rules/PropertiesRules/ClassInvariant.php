<?php

// Invariant: Account balance cannot be negative.

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

    public function withdraw(float $amount): void
    {
        if ($this->balance - $amount < 0) {
            throw new RuntimeException("Insufficient funds");
        }

        $this->balance -= $amount;

        echo "Amount withdrawn. Remaining balance is {$this->balance}\n";
    }
}

// Breaks the invariant: Negative balance is now allowed.
class CheatAccount extends BankAccount
{

    public function __construct(float $balance)
    {
        parent::__construct($balance);
    }

    public function withdraw(float $amount): void
    {
        // LSP violation: No check for insufficient funds.
        $this->balance -= $amount;

        echo "Amount withdrawn. Remaining balance is {$this->balance}\n";
    }
}

// Main
$bankAccount = new BankAccount(100);
$bankAccount->withdraw(100);

// Try this:
// $cheatAccount = new CheatAccount(100);
// $cheatAccount->withdraw(150);

?>

//? CLASS INVARIANT RULE:
// An invariant is a condition that must always remain true
// throughout an object's lifetime.

// A child class must maintain the parent's invariant.

// A child can strengthen the invariant (add more restrictions),
// but must never weaken it.

//* Example:
// Parent: BankAccount -> Balance cannot be negative.
// Child: CheatAccount -> Allows negative balance.

// Result: LSP violation because the child breaks the
// behavioral guarantee of the parent.