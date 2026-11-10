<?php

    // Normal class (Not a Singleton)
    class NoSingleton {

        // Constructor gets called whenever a new object is created
        public function __construct() {
            echo "Singleton Constructor called. New Object created.\n";
        }
    }

    // Creating the first object
    $s1 = new NoSingleton();

    // Creating the second object
    // Constructor will be called again because we are creating a new object
    $s2 = new NoSingleton();

    // == compares whether both objects have the same class and property values
    // === checks whether both variables point to the exact same object instance

    var_dump($s1 == $s2);  // Output: bool(true)
    var_dump($s1 === $s2); // Output: bool(false)

?>