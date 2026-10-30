<?php

// Abstraction (Interface)
interface Database
{
    public function save(string $data): void;
}

// MySQL implementation (Low-level module)
class MySQLDatabase implements Database
{
    public function save(string $data): void
    {
        echo "Executing SQL Query: INSERT INTO users VALUES('"
            . $data . "');\n";
    }
}

// MongoDB implementation (Low-level module)
class MongoDBDatabase implements Database
{
    public function save(string $data): void
    {
        echo "Executing MongoDB Function: db.users.insert({name: '"
            . $data . "'})\n";
    }
}

// High-level module (Loosely coupled via Dependency Injection)
class UserService
{
    private Database $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function storeUser(string $user): void
    {
        $this->db->save($user);
    }
}

// Main

$mysql = new MySQLDatabase();
$mongodb = new MongoDBDatabase();

$service1 = new UserService($mysql);
$service1->storeUser("Aditya");

$service2 = new UserService($mongodb);
$service2->storeUser("Rohit");

// Output:
// Executing SQL Query: INSERT INTO users VALUES('Aditya');
// Executing MongoDB Function: db.users.insert({name: 'Rohit'})
?>