<?php

// Low-level module
class MySQLDatabase
{
    public function saveToSQL(string $data): void
    {
        echo "Executing SQL Query: INSERT INTO users VALUES('"
            . $data . "');\n";
    }
}

// Low-level module
class MongoDBDatabase
{
    public function saveToMongo(string $data): void
    {
        echo "Executing MongoDB Function: db.users.insert({name: '"
            . $data . "'})\n";
    }
}

// High-level module (Tightly coupled)
class UserService
{
    private MySQLDatabase $sqlDb;
    private MongoDBDatabase $mongoDb;

    public function __construct()
    {
        $this->sqlDb = new MySQLDatabase();
        $this->mongoDb = new MongoDBDatabase();
    }

    public function storeUserToSQL(string $user): void
    {
        // MySQL-specific code
        $this->sqlDb->saveToSQL($user);
    }

    public function storeUserToMongo(string $user): void
    {
        // MongoDB-specific code
        $this->mongoDb->saveToMongo($user);
    }
}

// Main
$service = new UserService();

$service->storeUserToSQL("Aditya");
$service->storeUserToMongo("Rohit");

?>