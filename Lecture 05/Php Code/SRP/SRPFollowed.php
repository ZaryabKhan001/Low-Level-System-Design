<?php

// Product class representing an item in e-commerce.
class Product {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

// 1. ShoppingCart: Responsible for cart-related business logic.
class ShoppingCart {
    private $products = [];

    public function addProduct($product) {
        $this->products[] = $product;
    }

    public function getProducts() {
        return $this->products;
    }

    // Calculates the total price in the cart.
    public function calculateTotal() {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->price;
        }

        return $total;
    }
}

// 2. ShoppingCartPrinter: Responsible for printing invoices.
class ShoppingCartPrinter {
    private $cart;

    public function __construct($cart) {
        $this->cart = $cart;
    }

    public function printInvoice() {
        echo "Shopping Cart Invoice:\n";

        foreach ($this->cart->getProducts() as $product) {
            echo $product->name . " - Rs " . $product->price . "\n";
        }

        echo "Total: Rs " . $this->cart->calculateTotal() . "\n";
    }
}

// 3. ShoppingCartStorage: Responsible for storing the cart.
class ShoppingCartStorage {
    private $cart;

    public function __construct($cart) {
        $this->cart = $cart;
    }

    public function saveToDatabase() {
        echo "Saving shopping cart to database...\n";
    }
}

// Main execution.
$cart = new ShoppingCart();

$cart->addProduct(new Product("Laptop", 50000));
$cart->addProduct(new Product("Mouse", 2000));

$printer = new ShoppingCartPrinter($cart);
$printer->printInvoice();

$db = new ShoppingCartStorage($cart);
$db->saveToDatabase();

?>

// A has-a relationship means one object holds a reference to another object and uses it to perform its work.