
<?php

/*
Static Polymorphism (Compile-time Polymorphism):

The same action can behave differently depending on the input parameters.

In C++, we achieve this using method overloading.
In PHP, we can simulate this using optional parameters.
*/

class ManualCar
{
    private string $brand;
    private string $model;
    private bool $isEngineOn;
    private int $currentSpeed;
    private int $currentGear;

    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->isEngineOn = false;
        $this->currentSpeed = 0;
        $this->currentGear = 0;
    }

    public function startEngine(): void
    {
        $this->isEngineOn = true;

        echo $this->brand . " " . $this->model .
             " : Engine started." . PHP_EOL;
    }

    public function stopEngine(): void
    {
        $this->isEngineOn = false;
        $this->currentSpeed = 0;

        echo $this->brand . " " . $this->model .
             " : Engine turned off." . PHP_EOL;
    }

    // Simulating method overloading using an optional parameter.

    public function accelerate(?int $speed = null): void
    {
        if (!$this->isEngineOn) {
            echo $this->brand . " " . $this->model .
                 " : Cannot accelerate! Engine is off." .
                 PHP_EOL;
            return;
        }

        if ($speed === null) {
            $this->currentSpeed += 20;
        } else {
            $this->currentSpeed += $speed;
        }

        echo $this->brand . " " . $this->model .
             " : Accelerating to " . $this->currentSpeed .
             " km/h" . PHP_EOL;
    }

    public function brake(): void
    {
        $this->currentSpeed -= 20;

        if ($this->currentSpeed < 0) {
            $this->currentSpeed = 0;
        }

        echo $this->brand . " " . $this->model .
             " : Braking! Speed is now " . $this->currentSpeed .
             " km/h" . PHP_EOL;
    }

    public function shiftGear(int $gear): void
    {
        $this->currentGear = $gear;

        echo $this->brand . " " . $this->model .
             " : Shifted to gear " . $this->currentGear .
             PHP_EOL;
    }
}


// Main code

$myManualCar = new ManualCar("Suzuki", "WagonR");

$myManualCar->startEngine();

$myManualCar->accelerate();     // Increase speed by 20
$myManualCar->accelerate(40);   // Increase speed by 40

$myManualCar->brake();
$myManualCar->stopEngine();

?>
