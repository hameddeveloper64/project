<?php
namespace Magnet\App\Library;
class Cache {
	/**
	 * @var int
	 */
	private int $expire;
	
	/**
	 * Constructor
	 *
	 * @param    int  $expire
	 */
	public function __construct(int $expire = 3600) {
		$this->expire = $expire;
	}
	
	/**
	 * Get
	 *
	 * @param    string  $key
	 *
	 * @return array|string|null
	 */

	public function has(string $key){
		$file = glob(DIR_CACHE . 'mysql/cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		if($file)
			return true;
		else
			return false;	
	} 

	public function get(string $key) {
		$files = glob(DIR_CACHE . 'mysql/cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		if ($files) {
			return json_decode(file_get_contents($files[0]), true);
		} else {
			return [];
		}
	}

	/**
	 * Set
	 *
	 * @param    string  $key
	 * @param    array|string|null  $value
	 *
	 * @return void
	 */
	public function set(string $key, array|string|null $value, int $expire = 0): void {
		$this->delete($key);
		if (!$expire) {
			$expire = $this->expire;
		}
		file_put_contents(DIR_CACHE . 'mysql/cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $expire), json_encode($value));
	}

	/**
	 * Delete
	 *
	 * @param    string  $key
	 *
	 * @return void
	 */
	public function delete(string $key): void {
		$files = glob(DIR_CACHE . 'mysql/cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		if ($files) {
			foreach ($files as $file) {
				if (!@unlink($file)) {
					clearstatcache(false, $file);
				}
			}
		}
	}

	public function deleteAll(): void {
		$files = glob(DIR_CACHE . 'mysql/cache.*');
		if ($files) {
			foreach ($files as $file) {
				if (!@unlink($file)) {
					clearstatcache(false, $file);
				}
			}
		}
	}

	/**
	 * Destructor
	 */
	public function __destruct() {
		$files = glob(DIR_CACHE . 'mysql/cache.*');
		if ($files) {
			foreach ($files as $file) {
				$time = substr(strrchr($file, '.'), 1);
				if ($time < time()) {
					unlink($file);
				}
			}
		}
	}
}
