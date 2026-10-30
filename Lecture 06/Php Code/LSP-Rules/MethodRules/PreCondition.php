
<?php

// A precondition must be satisfied before a method executes.
// A subclass can weakens preconditions but cannot strengthen them.


class Car
{
    // Precondition: Speed must be greater than 0.
    public function brake(int $speed): void
    {
        if ($speed <= 0) {
            throw new InvalidArgumentException("Speed must be greater than 0");
        }

        echo "Applying brakes\n";
    }
}

class HybridCar extends Car
{
    // Same precondition as parent.
    // Child does not demand anything extra.
    public function brake(int $speed): void
    {
        if ($speed <= 0) {
            throw new InvalidArgumentException("Speed must be greater than 0");
        }

        echo "Applying brakes and charging battery\n";
    }
}

// Main
$car = new Car();
$car->brake(50);

$hybridCar = new HybridCar();
$hybridCar->brake(50);

?>
