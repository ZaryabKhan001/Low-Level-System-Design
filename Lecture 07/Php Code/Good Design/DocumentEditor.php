<?php

abstract class DocumentElement
{
    abstract public function render(): string;
}

class TextElement extends DocumentElement
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
    public function render(): string
    {
        return $this->text;
    }
}

class ImageElement extends DocumentElement
{
    private string $imagePath;

    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function render(): string
    {
        return "[Image: {$this->imagePath}]";
    }
}

class NewLineElement extends DocumentElement
{
    public function render(): string
    {
        return "\n";
    }
}

class tabSpaceElement extends DocumentElement
{
    public function render(): string
    {
        return "\t";
    }
}

//* Document Class
class Document
{
    private array $documentElements = [];

    public function addElement(DocumentElement $element): void
    {
        $this->documentElements[] = $element;
    }

    public function render(): string
    {
        $result = "";
        foreach ($this->documentElements as $element) {
            $result .= $element->render();
        }

        return $result;
    }
}

//* Persistence Class
interface Persistence
{
    public function save(string $data): void;
}

class FileStorage implements Persistence
{
    public function save(string $data): void
    {
        $result = file_put_contents("document.txt", $data);

        if ($result !== false) {
            echo "Document saved to document.txt" . PHP_EOL;
        } else {
            echo "Error: Unable to write file." . PHP_EOL;
        }
    }
}

class DBStorage implements Persistence
{
    public function save(string $data): void
    {
        // Save TO DB
    }
}

//* Document Editor Class (Main Class)
class DocumentEditor
{
    private Document $document;
    private Persistence $storage;

    public function __construct(Document $document, Persistence $storage)
    {
        $this->document = $document;
        $this->storage = $storage;
    }

    public function addText(string $text): void
    {
        $this->document->addElement(new TextElement($text));
    }

    public function addImage(string $imagePath): void
    {
        $this->document->addElement(
            new ImageElement($imagePath)
        );
    }

    public function addNewLine(): void
    {
        $this->document->addElement(new NewLineElement());
    }

    public function addTabSpace(): void
    {
        $this->document->addElement(new TabSpaceElement());
    }

    public function renderDocument(): string
    {
        return $this->document->render();
    }

    public function saveDocument(): void
    {
        $this->storage->save($this->renderDocument());
    }
}

$document = new Document();

$persistence = new FileStorage();

$editor = new DocumentEditor($document, $persistence);

// Add elements
$editor->addText("Hello, world!");

$editor->addNewLine();

$editor->addText(
    "This is a real-world document editor example."
);

$editor->addNewLine();

$editor->addTabSpace();

$editor->addText("Indented text after a tab space.");

$editor->addNewLine();

$editor->addImage("picture.jpg");

// Render and display
echo $editor->renderDocument() . PHP_EOL;

// Save document
$editor->saveDocument();

// Important concepts to remember
// - Abstraction: DocumentElement defines what every document element must implement.
// - Inheritance: TextElement, ImageElement, NewLineElement and TabSpaceElement extend DocumentElement.
// - Polymorphism: Same render() method, different implementations.
// - Encapsulation: Properties are private and accessed through class methods.
// - Interface: Persistence defines a contract that FileStorage and DBStorage must follow.
// - Dependency Injection: Document and Persistence objects are passed through the DocumentEditor constructor.
// - Dependency Inversion (DIP): DocumentEditor depends on the Persistence interface, not directly on FileStorage.
// - Open/Closed Principle (OCP): We can add new document elements and storage implementations without modifying the existing core classes.

//? Why are we using an abstract class for DocumentElement?
// We use an abstract class because all document elements share a common parent and must implement the render method. It provides a common abstraction and ensures that every document element follows the same structure.

//? Why are we using an interface for Persistence?
// We use an interface because different storage implementations need to follow the same contract. FileStorage and DBStorage have different implementations, but both must provide a save method. The interface ensures consistency without forcing them to share implementation.

//? How does polymorphism work inside Document's render() method?
// Polymorphism allows us to call the same render method on different document elements. Each element provides its own implementation of render(). At runtime, PHP automatically calls the appropriate implementation based on the actual object type.

//? Why does DocumentEditor receive Persistence through its constructor?
// We inject Persistence through the constructor so that DocumentEditor doesn't depend on a specific storage implementation. This makes our code loosely coupled. We can easily switch between FileStorage, DBStorage or other implementations without modifying DocumentEditor. This is constructor-based Dependency Injection and follows the Dependency Inversion Principle.

//? If we want to add PDFStorage, which existing classes need modification?
// No class should be modified. We are just going to implement a new class pdfStorage from interface Persistence. And use this storage whereever we want.

//* ABSTRACT CLASS:
// - Use when we want to write common code once in the parent and reuse it in children.
// - Can have a constructor and properties.
// - Can have normal methods with code.
// - Can have abstract methods that children MUST define.
// - Children use extends.

//* INTERFACE:
// - Use when we only want to define rules that classes MUST follow.
// - Every class must define all methods declared in the interface.
// - Cannot have an instance constructor or instance properties.
// - Cannot provide normal methods with code.
// - Children use implements.

//* REMEMBER:
// - Abstract class = Common code + Rules for children.
// - Interface = Rules that classes MUST follow.

//* EXAMPLE:
// - DocumentElement = Abstract class (all elements must have render()).
// - Persistence = Interface (all storage classes must have save()).

//* IMPORTANT:
// - Both can enforce methods.
// - Use abstract class when you also want to share code.
// - Use interface when you only want to enforce a contract.
