<?php
   
// Singleton Class
class SimpleSingleton
{
    // Shared property across the entire class
    // Initially, no object exists
    private static $instance = null;

    // Private constructor prevents creating objects using "new" outside this class
    private function __construct()
    {
        echo "Singleton Constructor called\n";
    }

    // Provides access to the single object
    public static function getInstance()
    {
        // Check whether an object has already been created
        if (self::$instance == null) {

            // Create the object only if it doesn't exist
            self::$instance = new SimpleSingleton();
        }

        // Return the existing object
        return self::$instance;
    }
}

// Get the first instance
$s1 = SimpleSingleton::getInstance();

// Get the second instance
$s2 = SimpleSingleton::getInstance();

// Both variables point to the exact same object
var_dump($s1 === $s2); // Output: bool(true)
