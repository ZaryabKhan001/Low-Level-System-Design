//? Strategy Design Pattern

//* 1. Define separate interfaces for different behaviours.
//    Example: TalkableRobot, WalkableRobot, FlyableRobot.

//* 2. Create different behaviour classes implementing those interfaces.
//    Example: NormalWalk, NoWalk, NormalFly, NoFly.

//* 3. Main Robot class uses these interfaces as properties.
//    It does not implement the behaviours itself.

//* 4. Pass the required behaviour objects through the constructor (Dependency Injection).

//* 5. Robot class delegates calls to the assigned behaviour objects.

//* 6. Different robot types can have different combinations of behaviours
//    without duplicating code.

//* KEY IDEA:
// "Favor composition over inheritance."

//* WHY USE IT?
// - Avoids large numbers of subclasses.
// - Makes behaviours reusable.
// - Easy to add or change behaviours.
// - Follows Open/Closed Principle.
// - Get rid of deep levels of inheriance

//* EXAMPLE:
// CompanionRobot = NormalWalk + NormalTalk + NoFly
// WorkerRobot    = NoWalk + NoTalk + NormalFly

<?php

//* Talkable Robot Interface
interface TalkableRobot
{
    public function talk(): string;
}

class NormalTalk implements TalkableRobot
{
    public function talk(): string
    {
        return 'Talking Normally...';
    }
}

class NoTalk implements TalkableRobot
{
    public function talk(): string
    {
        return 'Cannot Talk.';
    }
}

//* Walkable Robot Interface
interface WalkableRobot
{
    public function walk(): string;
}

class NormalWalk implements WalkableRobot
{
    public function walk(): string
    {
        return 'Walking Normally...';
    }
}

class NoWalk implements WalkableRobot
{
    public function walk(): string
    {
        return 'Cannot Walk.';
    }
}

//* Flyable Robot Robot Interface
interface FlyableRobot
{
    public function fly(): string;
}

class NormalFly implements FlyableRobot
{
    public function fly(): string
    {
        return 'Flying Normally...';
    }
}

class NoFly implements FlyableRobot
{
    public function fly(): string
    {
        return 'Cannot Fly.';
    }
}

//* Robot Class (Main Client)
abstract class Robot
{
    protected WalkableRobot $walkBehavior;
    protected TalkableRobot $talkBehavior;
    protected FlyableRobot $flyBehavior;

    public function __construct(WalkableRobot $walkBehavior, TalkableRobot $talkBehavior, FlyableRobot $flyBehavior)
    {
        $this->walkBehavior = $walkBehavior;
        $this->talkBehavior = $talkBehavior;
        $this->flyBehavior = $flyBehavior;
    }

    public function walk(): string
    {
        return $this->walkBehavior->walk();
    }

    public function talk(): string
    {
        return $this->talkBehavior->talk();
    }

    public function fly(): string
    {
        return $this->flyBehavior->fly();
    }

    abstract public function projection(): string;
}

// *
class CompanionRobot extends Robot
{

    public function projection(): string
    {
        return "Displaying friendly companion features...";
    }
}

class WorkerRobot extends Robot
{

    public function projection(): string
    {
        return "Displaying worker efficiency stats...";
    }
}

//* Testing
// Companion Robot
$robot1 = new CompanionRobot(
    new NormalWalk(),
    new NormalTalk(),
    new NoFly()
);

echo $robot1->walk() . PHP_EOL;
echo $robot1->talk() . PHP_EOL;
echo $robot1->fly() . PHP_EOL;
echo $robot1->projection() . PHP_EOL;

echo "--------------------" . PHP_EOL;

// Worker Robot
$robot2 = new WorkerRobot(
    new NoWalk(),
    new NoTalk(),
    new NormalFly()
);

echo $robot2->walk() . PHP_EOL;
echo $robot2->talk() . PHP_EOL;
echo $robot2->fly() . PHP_EOL;
echo $robot2->projection() . PHP_EOL;

?>