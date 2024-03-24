<?php

class Home extends Controller {
	
	public function index(){
		$this->model_common_home = $this->load->catalog->model("common/home");
		$this->model_common_home->getProducts();
		
	}
}

?>