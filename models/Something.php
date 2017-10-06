<?php
namespace Fizz\Buzz;

class Something {
	var $test = 0;
	
	function __construct() {
		$this->test = 1;
	}
	
	public function out() {
		echo $this->test;
	}
}