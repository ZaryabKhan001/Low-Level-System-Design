
<?php

/*
Encapsulation says 2 things:

1. An object's characteristics and behaviour are encapsulated together
   within that object.

2. Not all characteristics or behaviours should be accessible to everyone.
   The object should provide data security.

We achieve this by:
1. Keeping properties and methods together inside a class.
2. Using access modifiers such as public, private, and protected.
*/

class SportsCar
{
    private string $brand;
    private string $model;
    private bool $isEngineOn;
    private int $currentSpeed;
    private int $currentGear;

    // Introduce a new variable to explain setters.
    private string $tyreCompany;

    public function __construct(string $b, string $m)
    {
        $this->brand = $b;
        $this->model = $m;
        $this->isEngineOn = false;
        $this->currentSpeed = 0;
        $this->currentGear = 0;
        $this->tyreCompany = "MRF";
    }

    public function getSpeed(): int
    {
        return $this->currentSpeed;
    }

    public function getTyreCompany(): string
    {
        return $this->tyreCompany;
    }

    public function setTyreCompany(string $tyreCompany): void
    {
        $this->tyreCompany = $tyreCompany;
    }

    public function startEngine(): void
    {
        $this->isEngineOn = true;

        echo $this->brand . " " . $this->model .
             " : Engine starts with a roar!" . PHP_EOL;
    }

    public function shiftGear(int $gear): void
    {
        if (!$this->isEngineOn) {
            echo $this->brand . " " . $this->model .
                 " : Engine is off! Cannot Shift Gear." . PHP_EOL;
            return;
        }

        $this->currentGear = $gear;

        echo $this->brand . " " . $this->model .
             " : Shifted to gear " . $this->currentGear . PHP_EOL;
    }

    public function accelerate(): void
    {
        if (!$this->isEngineOn) {
            echo $this->brand . " " . $this->model .
                 " : Engine is off! Cannot accelerate." . PHP_EOL;
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

    public function stopEngine(): void
    {
        $this->isEngineOn = false;
        $this->currentGear = 0;
        $this->currentSpeed = 0;

        echo $this->brand . " " . $this->model .
             " : Engine turned off." . PHP_EOL;
    }
}

// Main code

$mySportsCar = new SportsCar("Ford", "Mustang");

$mySportsCar->startEngine();
$mySportsCar->shiftGear(1);
$mySportsCar->accelerate();
$mySportsCar->shiftGear(2);
$mySportsCar->accelerate();
$mySportsCar->brake();
$mySportsCar->stopEngine();

// We cannot directly access a private property:
// $mySportsCar->currentSpeed = 500; // Error

// We use the getter to read the private property.
echo "Current Speed of My Sports Car is " .
     $mySportsCar->getSpeed() . PHP_EOL;

// Use the setter to change the tyre company.
$mySportsCar->setTyreCompany("Michelin");

// Use the getter to read the updated tyre company.
echo "Tyre Company: " .
     $mySportsCar->getTyreCompany() . PHP_EOL;

?>
