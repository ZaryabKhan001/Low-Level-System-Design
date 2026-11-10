<?php

class ThreadSafeEagerSingleton
{
    // Create the instance immediately when the class is first used
    private static $instance = new ThreadSafeEagerSingleton();

    // Private constructor prevents external object creation
    private function __construct()
    {
        echo "Singleton Constructor Called!\n";
    }

    // Return the already-created instance
    public static function getInstance()
    {
        return self::$instance;
    }
}

// Get the first instance
$s1 = ThreadSafeEagerSingleton::getInstance();

// Get the second instance
$s2 = ThreadSafeEagerSingleton::getInstance();

// Check whether both variables reference the same object
var_dump($s1 === $s2); // true

?>