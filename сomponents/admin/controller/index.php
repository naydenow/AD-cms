<?php 

class index extends cms_core_CMSComponentController {
	public function index_action(){ 
		$this->setTemplate('main');
		$this->view(['bread_crumbs'=>['title'=>'Index']],'index')->render();
	}
	

	public function e404_action(){
		
	}

}

?>