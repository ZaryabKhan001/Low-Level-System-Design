
<?php

// --- Product 1 --> Burger ---

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


// --- Product 2 --> GarlicBread ---

interface GarlicBread
{
    public function prepare(): void;
}

class BasicGarlicBread implements GarlicBread
{
    public function prepare(): void
    {
        echo "Preparing Basic Garlic Bread with butter and garlic!\n";
    }
}

class CheeseGarlicBread implements GarlicBread
{
    public function prepare(): void
    {
        echo "Preparing Cheese Garlic Bread with extra cheese and butter!\n";
    }
}

class BasicWheatGarlicBread implements GarlicBread
{
    public function prepare(): void
    {
        echo "Preparing Basic Wheat Garlic Bread with butter and garlic!\n";
    }
}

class CheeseWheatGarlicBread implements GarlicBread
{
    public function prepare(): void
    {
        echo "Preparing Cheese Wheat Garlic Bread with extra cheese and butter!\n";
    }
}


// --- Abstract Factory ---

interface MealFactory
{
    public function createBurger(string $type): ?Burger;

    public function createGarlicBread(string $type): ?GarlicBread;
}


// --- Concrete Factory 1 ---

class SinghBurger implements MealFactory
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

    public function createGarlicBread(string $type): ?GarlicBread
    {
        if (strtolower($type) === "basic") {
            return new BasicGarlicBread();
        } else if (strtolower($type) === "cheese") {
            return new CheeseGarlicBread();
        } else {
            echo "Invalid Garlic bread type!\n";
            return null;
        }
    }
}


// --- Concrete Factory 2 ---

class KingBurger implements MealFactory
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

    public function createGarlicBread(string $type): ?GarlicBread
    {
        if (strtolower($type) === "basic") {
            return new BasicWheatGarlicBread();
        } else if (strtolower($type) === "cheese") {
            return new CheeseWheatGarlicBread();
        } else {
            echo "Invalid Garlic bread type!\n";
            return null;
        }
    }
}


// --- Main Class ---

class AbstractFactory
{
    public static function main(): void
    {
        $burgerType = "basic";
        $garlicBreadType = "cheese";

        $mealFactory = new SinghBurger();

        // Create products
        $burger = $mealFactory->createBurger($burgerType);
        $garlicBread = $mealFactory->createGarlicBread($garlicBreadType);

        // Prepare products
        if ($burger !== null) {
            $burger->prepare();
        }

        if ($garlicBread !== null) {
            $garlicBread->prepare();
        }
    }
}


// --- Client Code ---

AbstractFactory::main();

