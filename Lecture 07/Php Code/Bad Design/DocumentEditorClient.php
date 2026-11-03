<?php

class DocumentEditor
{
    private array $documentElements = [];
    private string $renderedDocuments = "";

    public function addText(string $text): void
    {
        if ($text === '') {
            return;
        }
        array_push($this->documentElements, $text);
    }
    public function addImage(string $imagePath): void
    {
        if ($imagePath === '') {
            return;
        }

        array_push($this->documentElements, $imagePath);
    }
    public function renderDocuments(): string
    {
        if (empty($this->renderedDocuments)) {
            $result = "";
            foreach ($this->documentElements as $element) {
                if (strlen($element) > 4 && (substr($element, -4) === ".jpg" ||
                    substr($element, -4) === ".png")) {
                    $result .= "[Image: " . $element . "]" . "\n";
                } else {
                    $result .= $element . "\n";
                }
            }
            $this->renderedDocuments = $result;
        }
        return $this->renderedDocuments;
    }
    public function saveToFile(): void
    {
        $file = fopen("document.txt", "w");

        if ($file !== false) {
            fwrite($file, $this->renderDocuments());

            fclose($file);

            echo "Document saved to document.txt\n";
        } else {
            echo "Error: Unable to open file for writing.\n";
        }
    }
}

$editor = new DocumentEditor();
$editor->addText("Hello, world!");

$editor->addImage("picture.jpg");
$editor->addText("This is a document editor.");

echo $editor->renderDocuments();

$editor->saveToFile();
