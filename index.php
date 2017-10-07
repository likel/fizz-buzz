<?php
/**
 * The index file, we can run our code from here
 *
 * A program which prints numbers from 1 to 100 with the following conditions:
 * 		multiples of 3 print "Fizz" instead of the number
 *   	multiples of 5 print "Buzz" instead of the number
 *    multiples of 3 & 5 print "FizzBuzz"
 *
 * @author Liam Kelly (likel)
 * @created 07/10/2017
 * @version 1.0.0
 */
require_once('autoload.php');

// Instantiate our Fizz Buzz object with our range
$fizz_buzz_object = new Fizz\Buzz\Object(1, 100);

// Add our rules
$fizz_buzz_object->addReplacement(3, "Fizz");
$fizz_buzz_object->addReplacement(5, "Buzz");

// Generate the sequence array
$fizz_buzz_object->generate();

// Echo the object, utilising the __toString method
echo $fizz_buzz_object;
