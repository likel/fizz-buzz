<?php
/**
 * The index file, we can run our code from here
 *
 * A program which prints numbers from 1 to 100 with the following conditions:
 *    multiples of 3 print "Fizz" instead of the number
 *    multiples of 5 print "Buzz" instead of the number
 *    multiples of 3 & 5 print "FizzBuzz"
 *
 * @package     fizz-buzz
 * @author      Liam Kelly <https://github.com/likel>
 * @copyright   2017 Liam Kelly
 * @license     https://github.com/likel/fizz-buzz/blob/master/LICENSE GPL-3.0 License
 * @link        https://github.com/likel/fizz-buzz
 * @version     1.0.0
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
