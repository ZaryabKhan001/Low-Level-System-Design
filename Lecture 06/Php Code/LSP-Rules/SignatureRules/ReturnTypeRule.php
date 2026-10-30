 <?php

// Return Type Rule:
// Subtype's overridden method return type should be either identical
// or narrower than the parent method's return type.
// This is called return type covariance.

class Animal {
    // Some common Animal methods
}

class Dog extends Animal {
    // Additional Dog methods specific to Dogs.
}

class ParentClass {
    public function getAnimal(): Animal {
        echo "Parent: Returning Animal instance\n";

        return new Animal();
    }
}

class ChildClass extends ParentClass {
    // Covariant return type: Dog is narrower than Animal.
    public function getAnimal(): Dog {
        echo "Child: Returning Dog instance\n";

        return new Dog();
    }
}

class Client {
    private ParentClass $p;

    public function __construct(ParentClass $p) {
        $this->p = $p;
    }

    public function takeAnimal(): void {
        $this->p->getAnimal();
    }
}

// Main
$parent = new ParentClass();
$child = new ChildClass();

$client = new Client($child);
// $client = new Client($parent);

$client->takeAnimal();

?>