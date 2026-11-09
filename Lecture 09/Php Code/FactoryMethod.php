
<?php

// Product Interface and subclasses
interface Burger
{
    public function prepare(): void;
}

class BasicBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Basic Burger with bun, patty, and ketchup!\n";
    }
}

class StandardBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Standard Burger with bun, patty, cheese, and lettuce!\n";
    }
}

class PremiumBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Premium Burger with gourmet bun, premium patty, cheese, lettuce, and secret sauce!\n";
    }
}

class BasicWheatBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Basic Wheat Burger with bun, patty, and ketchup!\n";
    }
}

class StandardWheatBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Standard Wheat Burger with bun, patty, cheese, and lettuce!\n";
    }
}

class PremiumWheatBurger implements Burger
{
    public function prepare(): void
    {
        echo "Preparing Premium Wheat Burger with gourmet bun, premium patty, cheese, lettuce, and secret sauce!\n";
    }
}


// Factory Interface and Concrete Factories
interface BurgerFactory
{
    public function createBurger(string $type): ?Burger;
}

class SinghBurger implements BurgerFactory
{
    public function createBurger(string $type): ?Burger
    {
        if (strtolower($type) === "basic") {
            return new BasicBurger();
        } else if (strtolower($type) === "standard") {
            return new StandardBurger();
        } else if (strtolower($type) === "premium") {
            return new PremiumBurger();
        } else {
            echo "Invalid burger type!\n";
            return null;
        }
    }
}

class KingBurger implements BurgerFactory
{
    public function createBurger(string $type): ?Burger
    {
        if (strtolower($type) === "basic") {
            return new BasicWheatBurger();
        } else if (strtolower($type) === "standard") {
            return new StandardWheatBurger();
        } else if (strtolower($type) === "premium") {
            return new PremiumWheatBurger();
        } else {
            echo "Invalid burger type!\n";
            return null;
        }
    }
}


// Main Class
class FactoryMethod
{
    public static function main(): void
    {
        $type = "basic";

        $myFactory = new SinghBurger();

        $burger = $myFactory->createBurger($type);

        if ($burger !== null) {
            $burger->prepare();
        }
    }
}


// Client Code
FactoryMethod::main();
