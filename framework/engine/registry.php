<?php
namespace Magnet\App\Engine;
class Registry {
	
	private array $data = [];

	public function get(string $key): object|null {
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	public function set(string $key, object $value) {
		$this->data[$key] = $value;
	}
	
	public function has(string $key) {
		return isset($this->data[$key]);
	}

	public function unset(string $key) {
		if (isset($this->data[$key])) {
			unset($this->data[$key]);
		}
	}
}
