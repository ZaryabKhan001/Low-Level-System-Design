<?php

class ParentClass
{
    public function print(string $msg): void
    {
        echo "Parent: " . $msg . PHP_EOL;
    }
}

class ChildClass extends ParentClass
{
    public function print(string $msg): void
    {
        echo "Child: " . $msg . PHP_EOL;
    }
}

class Client
{
    private ParentClass $p;

    public function __construct(ParentClass $p)
    {
        $this->p = $p;
    }

    public function printMsg(): void
    {
        $this->p->print("Hello");
    }
}

$parent = new ParentClass();
$child = new ChildClass();

$client1 = new Client($parent);
$client1->printMsg();

$client2 = new Client($child);
$client2->printMsg();