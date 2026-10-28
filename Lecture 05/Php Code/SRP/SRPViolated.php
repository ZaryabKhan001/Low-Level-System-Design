<?php

// Product class representing any item in an e-commerce application.
class Product {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

// Violating SRP: ShoppingCart handles multiple responsibilities.
class ShoppingCart {
    private $products = [];

    public function addProduct($product) {
        $this->products[] = $product;
    }

    public function getProducts() {
        return $this->products;
    }

    // 1. Calculates the total price in the cart.
    public function calculateTotal() {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->price;
        }

        return $total;
    }

    // 2. Violating SRP: Prints the invoice.
    public function printInvoice() {
        echo "Shopping Cart Invoice:\n";

        foreach ($this->products as $product) {
            echo $product->name . " - Rs " . $product->price . "\n";
        }

        echo "Total: Rs " . $this->calculateTotal() . "\n";
    }

    // 3. Violating SRP: Saves the cart to the database.
    public function saveToDatabase() {
        echo "Saving shopping cart to database...\n";
    }
}

// Main execution
$cart = new ShoppingCart();

$cart->addProduct(new Product("Laptop", 50000));
$cart->addProduct(new Product("Mouse", 2000));

$cart->printInvoice();
$cart->saveToDatabase();

?>