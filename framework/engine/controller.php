<?php
namespace Magnet\App\Engine;
class Controller {
	/**
	 * @var object|\Opencart\System\Engine\Registry
	 */
	public $registry;

	/**
	 * Constructor
	 *
	 * @param    object  $registry
	 */
	

	public function __get(string $key): object {
		if ($this->registry->has($key)) {
			return $this->registry->get($key);
		} else {
			throw new \Exception('Error: Could not call registry key ' . $key . '!');
		}
	}

	/**
	 * __set
	 *
	 * @param	string	$key
	 * @param	object	$value
	 *
	 * @return void
	 */
	public function __set(string $key, object $value): void {
		$this->registry->set($key, $value);
	}
}
