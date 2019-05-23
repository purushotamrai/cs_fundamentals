<?php

class HashTable {

	const FixedSizeArraySize = 5;
	private $arrayTable;

	public function __construct()
	{
		$this->arrayTable = new SplFixedArray(self::FixedSizeArraySize);
	}

	public function set($key, $value) {
		// Convert key to hash.
		$hashedKey = $this->toHash($key);
		if (isset($this->arrayTable[$hashedKey])) {
            // Hash Collision Detected.
            if (is_object($this->arrayTable[$hashedKey])) {
            	$this->arrayTable[$hashedKey]->$key = $value;
            }
            else {
            	$linkedList = new stdClass; 
            	$linkedList->$key = $value;
            	foreach ($this->arrayTable[$hashedKey] as $existing_key => $existing_value) {
            		$linkedList->$existing_key = $existing_value;
            	}
                $this->arrayTable[$hashedKey] = $linkedList;            	
            }
		}
		else {
			// Set the value.
			$this->arrayTable[$hashedKey] = [$key => $value];
		}
	}

	public function toHash($input) {
		$ascii_values = unpack("C*", $input);
		$sum = array_sum($ascii_values);
		return ($sum % self::FixedSizeArraySize);
	}

	public function get($key) {
		$value = NULL;

		// Find offset of index.
		$hashedKey = $this->toHash($key);
		if (isset($this->arrayTable[$hashedKey])) {
            // Check if linkedlist.
			if (is_object($this->arrayTable[$hashedKey])) {
				$value = $this->arrayTable[$hashedKey]->$key;				
			}
			else {
				$value = $this->arrayTable[$hashedKey][$key];
			}
		}
		return $value;
	}

}
