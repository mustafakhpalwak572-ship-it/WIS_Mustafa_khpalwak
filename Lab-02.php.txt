<?php

// Task 1
class Library{

	/* This value is a constant you should not change it becuse we define constant with
		const word and usually we declare the properties constant that is share for all or objects.
	*/
	const MAX_BOOKS = 3;

}
echo Library::MAX_BOOKS;
echo "<br>";



// Task 2

class StudentCounter
{
    public static $count = 0;

    public static function addStudent()
    {
        self::$count += 1;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo StudentCounter::$count;
echo "<br>";


// Task 3


abstract class Vehicle
{
    abstract public function start();
}

class Car extends Vehicle
{
    public function start()
    {
        echo "Car engine started.";
    }
}
 
class Bike extends Vehicle
{
    public function start()
    {
        echo "Bike started.";
    }
}

$car = new Car();
$bike = new Bike();

$car->start();
echo "<br>";
$bike->start();


?>
