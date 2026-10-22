
<?php

/*
Abstract class:
1. Acts as an interface for the outside world to operate the car.
2. Tells WHAT the car can do rather than HOW it does it.
3. We cannot directly create an object of an abstract class.
4. The child class must implement all inherited abstract methods
   unless the child class is also abstract.
*/

abstract class Car
{
    abstract public function startEngine();

    abstract public function shiftGear(int $gear);

    abstract public function accelerate();

    abstract public function brake();

    abstract public function stopEngine();
}

/*
Concrete class:
1. Provides the actual implementation of the abstract methods.
2. We can create objects of SportsCar.
3. SportsCar inherits the contract defined by Car.
*/

class SportsCar extends Car
{
    public string $brand;
    public string $model;
    public bool $isEngineOn;
    public int $currentSpeed;
    public int $currentGear;

    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->isEngineOn = false;
        $this->currentSpeed = 0;
        $this->currentGear = 0;
    }

    public function startEngine()
    {
        $this->isEngineOn = true;

        echo $this->brand . " " . $this->model .
             " : Engine starts with a roar!" . PHP_EOL;
    }

    public function shiftGear(int $gear)
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

    public function accelerate()
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

    public function brake()
    {
        $this->currentSpeed -= 20;

        if ($this->currentSpeed < 0) {
            $this->currentSpeed = 0;
        }

        echo $this->brand . " " . $this->model .
             " : Braking! Speed is now " . $this->currentSpeed .
             " km/h" . PHP_EOL;
    }

    public function stopEngine()
    {
        $this->isEngineOn = false;
        $this->currentGear = 0;
        $this->currentSpeed = 0;

        echo $this->brand . " " . $this->model .
             " : Engine turned off." . PHP_EOL;
    }
}

// Main code

$myCar = new SportsCar("Ford", "Mustang");

// Same parent-type reference idea as C++
function operateCar(Car $car)
{
    $car->startEngine();
    $car->shiftGear(1);
    $car->accelerate();
    $car->shiftGear(2);
    $car->accelerate();
    $car->brake();
    $car->stopEngine();
}

operateCar($myCar);

?>
