
<?php

// Account interface
interface Account {
    public function deposit($amount);
    public function withdraw($amount);
}

class SavingAccount implements Account {
    private $balance;

    public function __construct() {
        $this->balance = 0;
    }

    public function deposit($amount) {
        $this->balance += $amount;

        echo "Deposited: " . $amount .
             " in Savings Account. New Balance: " .
             $this->balance . "\n";
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;

            echo "Withdrawn: " . $amount .
                 " from Savings Account. New Balance: " .
                 $this->balance . "\n";
        } else {
            echo "Insufficient funds in Savings Account!\n";
        }
    }
}

class CurrentAccount implements Account {
    private $balance;

    public function __construct() {
        $this->balance = 0;
    }

    public function deposit($amount) {
        $this->balance += $amount;

        echo "Deposited: " . $amount .
             " in Current Account. New Balance: " .
             $this->balance . "\n";
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;

            echo "Withdrawn: " . $amount .
                 " from Current Account. New Balance: " .
                 $this->balance . "\n";
        } else {
            echo "Insufficient funds in Current Account!\n";
        }
    }
}

class FixedTermAccount implements Account {
    private $balance;

    public function __construct() {
        $this->balance = 0;
    }

    public function deposit($amount) {
        $this->balance += $amount;

        echo "Deposited: " . $amount .
             " in Fixed Term Account. New Balance: " .
             $this->balance . "\n";
    }

    public function withdraw($amount) {
        throw new BadMethodCallException(
            "Withdrawal not allowed in Fixed Term Account!"
        );
    }
}

class BankClient {
    private $accounts;

    public function __construct($accounts) {
        $this->accounts = $accounts;
    }

    public function processTransactions() {
        foreach ($this->accounts as $account) {
            // All accounts allow deposits.
            $account->deposit(1000);

            // LSP violation: assuming all accounts support withdrawal.
            try {
                $account->withdraw(500);
            } catch (BadMethodCallException $e) {
                echo "Exception: " . $e->getMessage() . "\n";
            }
        }
    }
}

// Main execution
$accounts = [
    new SavingAccount(),
    new CurrentAccount(),
    new FixedTermAccount()
];

$client = new BankClient($accounts);
$client->processTransactions();

?>
