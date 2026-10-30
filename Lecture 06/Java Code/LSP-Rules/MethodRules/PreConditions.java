<?php

class Car {
    protected int $speed;

    public function __construct() {
        $this->speed = 0;
    }

    public function accelerate(): void {
        echo "Accelerating\n";
        $this->speed += 20;
    }

    // Postcondition: Speed must reduce after braking.
    public function brake(): void {
        echo "Applying brakes\n";
        $this->speed -= 20;
    }
}

class HybridCar extends Car {
    private int $charge;

    public function __construct() {
        parent::__construct();
        $this->charge = 0;
    }

    // Strengthened postcondition:
    // 1. Speed must reduce.
    // 2. Battery charge must increase.
    public function brake(): void {
        echo "Applying brakes\n";

        $this->speed -= 20;
        $this->charge += 10;
    }
}

// Main
$hybridCar = new HybridCar();
$hybridCar->brake();

?>