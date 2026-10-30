//? LSP Exception Rule:

// A child method should not introduce new or broader
// exceptions that the parent method's callers are
// not prepared to handle.

// A child can throw:
// 1. The same exception type.
// 2. A narrower exception (subclass of parent's exception).
// 3. Fewer exceptions.

// PHP does not enforce this rule in method signatures.
// It is a behavioral/design responsibility.

//? Remember the difference:
// - Java: Enforces this restriction for checked exceptions.
// - PHP: Does not declare exceptions in method signatures or enforce this restriction.
// - LSP: Still expects child classes to preserve the parent's behavioral contract.

<?php

class ParentException extends Exception {}

class ChildException extends ParentException {}

class ParentClass {
    public function getValue(): void {
        throw new ParentException("Parent error");
    }
}

class ChildClass extends ParentClass {
    public function getValue(): void {
        throw new ChildException("Child error");
    }
}

class Client {
    private ParentClass $p;

    public function __construct(ParentClass $p) {
        $this->p = $p;
    }

    public function takeValue(): void {
        try {
            $this->p->getValue();
        } catch (ParentException $e) {
            echo "ParentException occurred: " . $e->getMessage();
        }
    }
}

$parent = new ParentClass();
$child = new ChildClass();

$client = new Client($child);
$client->takeValue();

?>