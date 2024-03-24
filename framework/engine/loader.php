<?php
namespace Magnet\App\Engine;
class Loader {
	
	public $admin;
	public $catalog;

	  public function __construct($registery) {
		$this->admin = $registery->get("admin");
		$this->catalog = $registery->get("catalog");
	  }
}

