<?php

class HashTable {

	const FixedSizeArraySize = 5;
	private $indices;
	private $values;
	private $currentOffset;

	public function __construct()
	{
		$this->indices = new SplFixedArray(self::FixedSizeArraySize);
		$this->values = new SplFixedArray(self::FixedSizeArraySize);
	}

	public function set($id, $value) {
		// Get next offset.
		$this->setNextOffset();
		$offset = $this->currentOffset;
		$this->indices[$offset] = $id;
		$this->values[$offset] = $value;
	}

	private function setNextOffset() {
		if (isset($this->currentOffset)) {
			$this->currentOffset++;
		}
		else {
			$this->currentOffset = 0;
		}

		// Check if currentOffset is available.
		$currentSize = $this->indices->getSize();
		if ($this->currentOffset >= $currentSize) {
			// Increase size of indices and values.
			$newSize = $currentSize + self::FixedSizeArraySize;
			$this->indices->setSize($newSize);
			$this->values->setSize($newSize);
		}
	}

	public function get($id) {
		$value = NULL;

		// Find offset of index.
		$offset = $this->getOffset('indices', $id);
		if (isset($offset)) {
			$value = $this->values[$offset];
		}
		return $value;
	}

	private function getOffset($type, $value) {
		$offset = NULL;
		switch ($type) {
			case 'indices':
				foreach ($this->indices as $delta => $data) {
					if ($data === $value) {
						$offset = $delta;
					}
				}
				break;
			
			case 'values':
				foreach ($this->values as $offset => $index) {
					if ($data === $value) {
						$offset = $delta;
					}
				}
				break;
		}
		return $offset;	
	}

	public function update($id, $value) {
		$offset = $this->getOffset('indices', $id);
		$this->values[$offset] = $value;
	}

	public function delete($id) {
		$offset = $this->getOffset('indices', $id);
		$this->indices->offsetUnset($offset);
		$this->values->offsetUnset($offset);

		// Reset offsets.
		for ($i = $offset; $i < $this->currentOffset; $i++) {
			$this->indices[$i] = $this->indices[$i + 1];
			$this->values[$i] = $this->values[$i + 1];
		}
		$this->indices->offsetUnset($this->currentOffset);
		$this->values->offsetUnset($this->currentOffset);
		$this->currentOffset--;
	}
}
