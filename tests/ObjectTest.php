<?php
/**
 * PHPUnit tests for models/Object.php
 *
 * @author Liam Kelly (likel)
 * @created 07/10/2017
 * @version 1.0.0
 */
use PHPUnit\Framework\TestCase;

// Require the autoloader to load the Object when required
require_once(__DIR__ . '/../autoload.php');

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
     */
    public function testGetSingularValue() {
        
    }
}
