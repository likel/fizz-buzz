<?php
/**
 * The FizzBuzz object to handle the FizzBuzz functions
 *
 * @author Liam Kelly (likel)
 * @created 07/10/2017
 * @version 1.0.0
 */
namespace Fizz\Buzz;

class Object {

		// Helper variables used in the object
		var $sequence = array();
		var $replacement_list = array();
		var $range = array();

		/**
		 * Construct the FizzBuzz object
		 * Sets up the range, defaults to 1-100 if no range set
		 *
		 * @param int $range_min The minimum range for the sequence
		 * @param int $range_max The maximum range for the sequence
		 * @return void
		 */
		function __construct($range_min = 1, $range_max = 100) {
				$this->setRange($range_min, $range_max);
		}

		/**
		 * Sets the range for the FizzBuzz test
		 * Expects is_numeric params
		 *
 	 	 * @param int $range_min The minimum range for the sequence
		 * @param int $range_max The maximum range for the sequence
		 * @return void
		 */
		public function setRange($range_min, $range_max) {
				if(is_numeric($range_min)) {
						$this->range['min'] = $range_min;
				}

				if(is_numeric($range_min)) {
						$this->range['max'] = $range_max;
				}
		}

		/**
		 * Add a replacement option for the test
		 * Expects $number param to be numeric
		 *
 	 	 * @param int $number The key value to be replaced
		 * @param string/int $text The replacement when $number is found
		 * @return void
		 */
		public function addReplacement($number, $text) {
				if(is_numeric($number)) {
						$this->replacement_list[] = array(
								"key" => $number,
								"value" => $text
						);

						return true;
				} else {
						return false;
				}
		}

		/**
		 * Returns a singular value in the FizzBuzz test
		 * Uses the replacement_list does not consider the range
		 *
		 * @param int $number The number to check
		 * @return string/int
		 */
		public function getSingularValue($number) {
				if(!is_numeric($number)) {
						return false;
				}

				$string_value = "";

				foreach($this->replacement_list as $a_replacement) {
						if(is_numeric($a_replacement['key'])) {
								$string_value .= ($number % $a_replacement['key']) ? $a_replacement['value'] : "";
						}
				}

				return !empty($string_value) ? $string_value : $number;
		}

		/**
		 * Generate the final sequence using range and replacements
		 *
		 * @param bool $return Decide if we return
		 * @return string/int
		 */
		public function generate($return = false) {
				unset($this->sequence);

				for ($number = $this->range['min']; $number <= $this->range['max']; $number++) {
						$this->sequence[] = $this->getSingularValue($number);
				}

				if($return) {
						return $this->__toString();
				}
		}

		/**
		 * Getter. Returns $this->sequence
		 *
		 * @return array
		 */
		public function getSequence() {
				return $this->sequence;
		}

		/**
		 * Getter. Returns $this->range
		 *
		 * @return array
		 */
		public function getRange() {
				return $this->range;
		}

		/**
		 * Getter. Returns $this->replacement_list
		 *
		 * @return array
		 */
		public function getReplacementList() {
				return $this->replacement_list;
		}

		/**
		 * Returns $this->sequence as our final joined string
		 * This is called when echo is used on our Object class
		 *
		 * @return string
		 */
		public function __toString() {
				return !empty($this->sequence) ? join(', ', $this->sequence) : "The sequence is empty.";
	  }
}
