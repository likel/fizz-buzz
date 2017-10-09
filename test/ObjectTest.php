<?php
/**
 * PHPUnit tests for models/Object.php
 *
 * @package     fizz-buzz
 * @author      Liam Kelly <https://github.com/likel>
 * @copyright   2017 Liam Kelly
 * @license     https://github.com/likel/fizz-buzz/blob/master/LICENSE GPL-3.0 License
 * @link        https://github.com/likel/fizz-buzz
 * @version     1.0.1
 */
use PHPUnit\Framework\TestCase;

// Require the autoloader to load the Object when required
require_once(__DIR__ . '/../src/autoload.php');

final class ObjectTest extends TestCase {
    /**
     * Test for the constructor outcomes
     */
    public function testConstructRanges() {
        // Test no range given
        $fizz_buzz_object = new Fizz\Buzz\Object();
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], 1);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 100);

        // 1 value supplied
        $fizz_buzz_object = new Fizz\Buzz\Object(5);
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], 5);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 100);

        // Test for 1-100 range
        $fizz_buzz_object = new Fizz\Buzz\Object(1, 100);
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], 1);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 100);

        // Test a negative value and string value
        $fizz_buzz_object = new Fizz\Buzz\Object(-50, 'a');
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], -50);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 100);

        // Test a minimum range smaller than max range
        $fizz_buzz_object = new Fizz\Buzz\Object(100, 10);
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], 1);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 100);
    }

    /**
     * Test setting the range after constructed
     */
    public function testSetRange() {
        $fizz_buzz_object = new Fizz\Buzz\Object(1, 100);
        $fizz_buzz_object->setRange(5, 50);
        $this->assertArrayHasKey('min', $fizz_buzz_object->getRange());
        $this->assertArrayHasKey('max', $fizz_buzz_object->getRange());
        $this->assertEquals($fizz_buzz_object->getRange()['min'], 5);
        $this->assertEquals($fizz_buzz_object->getRange()['max'], 50);
    }

    /**
     * Test adding a replacement to the replacement list
     */
    public function testAddReplacement() {
        $fizz_buzz_object = new Fizz\Buzz\Object();

        // Test a correct replacement
        $this->assertTrue($fizz_buzz_object->addReplacement(3, "Fizz"));
        $this->assertArrayHasKey('key', $fizz_buzz_object->getReplacementList()[0]);
        $this->assertArrayHasKey('value', $fizz_buzz_object->getReplacementList()[0]);
        $this->assertEquals($fizz_buzz_object->getReplacementList()[0]['key'], 3);
        $this->assertEquals($fizz_buzz_object->getReplacementList()[0]['value'], "Fizz");

        // More correct replacements
        $this->assertTrue($fizz_buzz_object->addReplacement("3", "Fizz"));
        $this->assertTrue($fizz_buzz_object->addReplacement(5, 3));

        // Test a false replacement
        $this->assertFalse($fizz_buzz_object->addReplacement("a", "Fizz"));

        // Get the count of all of the above
        $this->assertEquals(count($fizz_buzz_object->getReplacementList()), 3);
    }

    /**
     * Test getting a singular value from a list
     * Range is not necessary
     */
    public function testGetSingularValue() {
        $fizz_buzz_object = new Fizz\Buzz\Object();
        $fizz_buzz_object->addReplacement(3, "Fizz");
        $fizz_buzz_object->addReplacement(5, "Buzz");

        // Correct values
        $this->assertEquals($fizz_buzz_object->getSingularValue(3), "Fizz");
        $this->assertEquals($fizz_buzz_object->getSingularValue(5), "Buzz");
        $this->assertEquals($fizz_buzz_object->getSingularValue(15), "FizzBuzz");
        $this->assertEquals($fizz_buzz_object->getSingularValue(2), 2);
        $this->assertEquals($fizz_buzz_object->getSingularValue(-2), -2);
        $this->assertEquals($fizz_buzz_object->getSingularValue(-3), "Fizz");

        // Test incorrect value
        $this->assertFalse($fizz_buzz_object->getSingularValue("a"));
    }

    /**
     * Test generating the range string
     */
    public function testGenerate() {
        $fizz_buzz_object = new Fizz\Buzz\Object(1, 15);
        $fizz_buzz_object->addReplacement(3, "Fizz");
        $fizz_buzz_object->addReplacement(5, "Buzz");

        $expected = array(1, 2, "Fizz", 4, "Buzz", "Fizz", 7, 8, "Fizz", "Buzz", 11, "Fizz", 13, 14, "FizzBuzz");

        // Test for empty sequences
        $this->assertEmpty($fizz_buzz_object->getSequence());
        $this->assertEquals((string)$fizz_buzz_object, "The sequence is empty.");

        // Correct sequence
        $fizz_buzz_object->generate();
        $this->assertEquals(count($fizz_buzz_object->getSequence()), 15);
        $this->assertEquals($fizz_buzz_object->getSequence(), $expected);
        $this->assertEquals((string)$fizz_buzz_object, join(', ', $expected));

        // Test return generate
        $this->assertEquals($fizz_buzz_object->generate(true), join(', ', $expected));

        // Test for 0 - 0 range
        $fizz_buzz_object = new Fizz\Buzz\Object(0, 0);
        $this->assertEquals((string)$fizz_buzz_object, "The sequence is empty.");
    }
}
