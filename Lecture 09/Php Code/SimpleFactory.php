<?php

interface Burger
{
    public function prepare(): string;
}

class BasicBurger implements Burger
{
    public function prepare(): string
    {
        return 'Preparing Basic Burger with bun, patty, and ketchup!';
    }
}

class StandardBurger implements Burger
{
    public function prepare(): string
    {
        return 'Preparing Standard Burger with bun, patty, cheese, and lettuce!';
    }
}

class PremiumBurger implements Burger
{
    public function prepare(): string
    {
        return 'Preparing Premium Burger with gourmet bun, premium patty, cheese, lettuce, and secret sauce!';
    }
}

// Burger Factory
class BurgerFactory
{
    public function createBurger(string $type): ?Burger
    {
        if ($type === 'basic') {
            return new BasicBurger();
        } else if ($type === 'standard') {
            return new StandardBurger();
        } else if ($type === 'premium') {
            return new PremiumBurger();
        }

        return null;
    }
}

// Main Class
class SimpleFactory
{
    private BurgerFactory $factory;

    public function __construct()
    {
        $this->factory = new BurgerFactory();
    }

    public function orderBurger(string $type): void
    {
        $burger = $this->factory->createBurger($type);

        if ($burger === null) {
            echo "Invalid burger type!";
            return;
        }

        echo $burger->prepare();
    }
}

// Client Code
$restaurant = new SimpleFactory();

$restaurant->orderBurger('basic');

echo "\n";

$restaurant->orderBurger('standard');

echo "\n";

$restaurant->orderBurger('premium');