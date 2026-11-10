<?php

class ThreadSafeSingleton
{
    // Static instance
    private static $instance = null;

    // Shared synchronization object
    private static $mutex;

    // Private constructor
    private function __construct()
    {
        echo "Singleton Constructor Called!\n";
    }

    // Set the mutex
    public static function setMutex($mutex)
    {
        self::$mutex = $mutex;
    }

    public static function getInstance()
    {
        // Execute the critical section under synchronization
        return (self::$mutex)(function () {

            // Check if instance already exists
            if (self::$instance === null) {

                // Create the instance
                self::$instance = new ThreadSafeSingleton();
            }

            // Return the instance
            return self::$instance;
        });
    }
}

// Create synchronization object
$mutex = new \parallel\Sync();

// Set mutex
ThreadSafeSingleton::setMutex($mutex);

// Get first instance
$s1 = ThreadSafeSingleton::getInstance();

// Get second instance
$s2 = ThreadSafeSingleton::getInstance();

// Compare object identity
var_dump($s1 === $s2); // true

?>