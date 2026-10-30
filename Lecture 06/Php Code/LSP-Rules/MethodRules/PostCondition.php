
<?php

// A postcondition must be satisfied after a method executes.
// A subclass can strengthen postconditions but cannot weaken them.

class Car
{
    protected int $speed;

    public function __construct()
    {
        $this->speed = 0;
    }

    public function accelerate(): void
    {
        echo "Accelerating\n";

        $this->speed += 20;
    }

    // Postcondition: Speed must reduce after braking.
    public function brake(): void
    {
        echo "Applying brakes\n";

        $this->speed -= 20;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }
}

// HybridCar extends Car.
class HybridCar extends Car
{
    private int $charge;

    public function __construct()
    {
        parent::__construct();

        $this->charge = 0;
    }

    // Parent postcondition: Speed must reduce.
    // Additional postcondition: Charge must increase.
    public function brake(): void
    {
        echo "Applying brakes\n";

        $this->speed -= 20;

        $this->charge += 10;
    }

    public function getCharge(): int
    {
        return $this->charge;
    }
}

// Client code
$hybridCar = new HybridCar();

$hybridCar->accelerate();
$hybridCar->brake();

echo "Speed: " . $hybridCar->getSpeed() . "\n";
echo "Charge: " . $hybridCar->getCharge() . "\n";
