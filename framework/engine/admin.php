<?php
namespace Magnet\App\Engine;

class Admin {
	public $registry;
	
  public function model(string $path) {
    $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', $path);
	$file  = MAGNET_DIR . '/admin/model/' . $route . '.php';
	if (is_file($file)) {
		include_once($file);
	
  }
}
}

