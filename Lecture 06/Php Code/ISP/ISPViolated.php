
<?php

// Single interface for all shapes (Violates ISP).
interface Shape
{
    public function area(): float;

    public function volume(): float;
    // 2D shapes don't have volume!
}

// Square is a 2D shape but is forced to implement volume().
class Square implements Shape
{
    private float $side;

    public function __construct(float $s)
    {
        $this->side = $s;
    }

    public function area(): float
    {
        return $this->side * $this->side;
    }

    public function volume(): float
    {
        throw new BadMethodCallException(
            "Volume not applicable for Square"
        );
    }
}

// Rectangle is also a 2D shape but is forced to implement volume().
class Rectangle implements Shape
{
    private float $length;
    private float $width;

    public function __construct(float $l, float $w)
    {
        $this->length = $l;
        $this->width = $w;
    }

    public function area(): float
    {
        return $this->length * $this->width;
    }

    public function volume(): float
    {
        throw new BadMethodCallException(
            "Volume not applicable for Rectangle"
        );
    }
}

// Cube is a 3D shape, so it actually has a volume.
class Cube implements Shape
{
    private float $side;

    public function __construct(float $s)
    {
        $this->side = $s;
    }

    public function area(): float
    {
        return 6 * $this->side * $this->side;
    }

    public function volume(): float
    {
        return $this->side * $this->side * $this->side;
    }
}

// Main

$square = new Square(5);
$rectangle = new Rectangle(4, 6);
$cube = new Cube(3);

echo "Square Area: " . $square->area() . "\n";

echo "Rectangle Area: " . $rectangle->area() . "\n";

echo "Cube Area: " . $cube->area() . "\n";

echo "Cube Volume: " . $cube->volume() . "\n";

try {
    echo "Square Volume: " . $square->volume() . "\n";
} catch (BadMethodCallException $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

?>
