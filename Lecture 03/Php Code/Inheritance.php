
<?php

/*
Inheritance:

1. Child classes inherit common characteristics and behaviours
   from the parent class.

2. The parent class contains properties and methods common to all cars.

3. Each child class adds its own specific properties and methods.

4. This provides code reusability.
*/

class Car
{
    protected string $brand;
    protected string $model;
    protected bool $isEngineOn;
    protected int $currentSpeed;

    public function __construct(string $b, string $m)
    {
        $this->brand = $b;
        $this->model = $m;
        $this->isEngineOn = false;
        $this->currentSpeed = 0;
    }

    // Common methods for all cars.

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

    public function accelerate(): void
    {
        if (!$this->isEngineOn) {
            echo $this->brand . " " . $this->model .
                 " : Cannot accelerate! Engine is off." .
                 PHP_EOL;
            return;
        }

        $this->currentSpeed += 20;

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
}


class ManualCar extends Car
{
    // Specific to Manual Car.
    private int $currentGear;

    public function __construct(string $b, string $m)
    {
        parent::__construct($b, $m);

        $this->currentGear = 0;
    }

    // Specialized method for Manual Car.
    public function shiftGear(int $gear): void
    {
        $this->currentGear = $gear;

        echo $this->brand . " " . $this->model .
             " : Shifted to gear " . $this->currentGear .
             PHP_EOL;
    }
}


class ElectricCar extends Car
{
    // Specific to Electric Car.
    private int $batteryLevel;

    public function __construct(string $b, string $m)
    {
        parent::__construct($b, $m);

        $this->batteryLevel = 100;
    }

    // Specialized method for Electric Car.
    public function chargeBattery(): void
    {
        $this->batteryLevel = 100;

        echo $this->brand . " " . $this->model .
             " : Battery fully charged!" . PHP_EOL;
    }
}


// Main code

$myManualCar = new ManualCar("Suzuki", "WagonR");

$myManualCar->startEngine();
$myManualCar->shiftGear(1);
$myManualCar->accelerate();
$myManualCar->brake();
$myManualCar->stopEngine();

echo "----------------------" . PHP_EOL;

$myElectricCar = new ElectricCar("Tesla", "Model S");

$myElectricCar->chargeBattery();
$myElectricCar->startEngine();
$myElectricCar->accelerate();
$myElectricCar->brake();
$myElectricCar->stopEngine();

?>
