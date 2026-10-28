
<?php

// Product class representing any item in e-commerce.
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

// Abstract class defining the persistence contract.
abstract class Persistence {
    abstract public function save($cart);
}

// Save cart data to SQL database.
class SQLPersistence extends Persistence {
    public function save($cart) {
        echo "Saving shopping cart to SQL DB...\n";
    }
}

// Save cart data to MongoDB.
class MongoPersistence extends Persistence {
    public function save($cart) {
        echo "Saving shopping cart to MongoDB...\n";
    }
}

// Save cart data to a file.
class FilePersistence extends Persistence {
    public function save($cart) {
        echo "Saving shopping cart to a file...\n";
    }
}

// Main execution.
$cart = new ShoppingCart();

$cart->addProduct(new Product("Laptop", 50000));
$cart->addProduct(new Product("Mouse", 2000));

$printer = new ShoppingCartPrinter($cart);
$printer->printInvoice();

// Polymorphism: Same interface, different implementations.
$db = new SQLPersistence();
$mongo = new MongoPersistence();
$file = new FilePersistence();

$db->save($cart);
$mongo->save($cart);
$file->save($cart);

?>
