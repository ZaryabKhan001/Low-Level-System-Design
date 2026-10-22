
<?php

/*
Dynamic Polymorphism:

1. Objects from the same family can respond to the same method call
   differently.

2. The parent class defines common properties and behaviours.
   It also declares abstract methods that child classes must implement.

3. Each child class provides its own implementation of those methods.
*/

abstract class Car
{
    protected string $brand;
    protected string $model;
    protected bool $isEngineOn;
    protected int $currentSpeed;

    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
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

    // Abstract methods for dynamic polymorphism.

    abstract public function accelerate(): void;

    abstract public function brake(): void;
}


class ManualCar extends Car
{
    private int $currentGear;

    public function __construct(string $brand, string $model)
    {
        parent::__construct($brand, $model);

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

    // Overriding accelerate - Dynamic Polymorphism.

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

    // Overriding brake - Dynamic Polymorphism.

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


class ElectricCar extends Car
{
    private int $batteryLevel;

    public function __construct(string $brand, string $model)
    {
        parent::__construct($brand, $model);

        $this->batteryLevel = 100;
    }

    // Specialized method for Electric Car.

    public function chargeBattery(): void
    {
        $this->batteryLevel = 100;

        echo $this->brand . " " . $this->model .
             " : Battery fully charged!" . PHP_EOL;
    }

    // Overriding accelerate - Dynamic Polymorphism.

    public function accelerate(): void
    {
        if (!$this->isEngineOn) {
            echo $this->brand . " " . $this->model .
                 " : Cannot accelerate! Engine is off." .
                 PHP_EOL;
            return;
        }

        if ($this->batteryLevel <= 0) {
            echo $this->brand . " " . $this->model .
                 " : Battery dead! Cannot accelerate." .
                 PHP_EOL;
            return;
        }

        $this->batteryLevel -= 10;
        $this->currentSpeed += 15;

        echo $this->brand . " " . $this->model .
             " : Accelerating to " . $this->currentSpeed .
             " km/h. Battery at " . $this->batteryLevel .
             "%." . PHP_EOL;
    }

    // Overriding brake - Dynamic Polymorphism.

    public function brake(): void
    {
        $this->currentSpeed -= 15;

        if ($this->currentSpeed < 0) {
            $this->currentSpeed = 0;
        }

        echo $this->brand . " " . $this->model .
             " : Regenerative braking! Speed is now " .
             $this->currentSpeed . " km/h. Battery at " .
             $this->batteryLevel . "%." . PHP_EOL;
    }
}


// Main code

$myManualCar = new ManualCar("Suzuki", "WagonR");

$myManualCar->startEngine();
$myManualCar->accelerate();
$myManualCar->accelerate();
$myManualCar->brake();
$myManualCar->stopEngine();

echo "----------------------" . PHP_EOL;

$myElectricCar = new ElectricCar("Tesla", "Model S");

$myElectricCar->startEngine();
$myElectricCar->accelerate();
$myElectricCar->accelerate();
$myElectricCar->brake();
$myElectricCar->stopEngine();

?>
