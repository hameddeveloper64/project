<?php
namespace Magnet\App\Library;
class Request {
	/**
	 * @var array|mixed
	 */
	public array $get = [];
	/**
	 * @var array|mixed
	 */
	public array $post = [];
	/**
	 * @var array|mixed
	 */
	public array $cookie = [];
	/**
	 * @var array|mixed
	 */
	public array $files = [];
	/**
	 * @var array|mixed
	 */
	public array $server = [];
	
	/**
	 * Constructor
 	*/
	public function __construct() {
		$this->get = $this->clean($_GET);
		$this->post = $this->clean($_POST);
		$this->cookie = $this->clean($_COOKIE);
		$this->files = $this->clean($_FILES);
		$this->server = $this->clean($_SERVER);
	}
	
	/**
     * Clean
	 *
	 * @param	mixed	$data
	 *
     * @return	mixed
     */
	public function clean(mixed $data): mixed {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = trim(htmlspecialchars($data, ENT_COMPAT, 'UTF-8'));
		}

		return $data;
	}
}