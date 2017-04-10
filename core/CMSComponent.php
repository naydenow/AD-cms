<?php

namespace cms\core;

class CMSComponent {
	public  $routs;
	public  $componentName;
	public  $initOptions;
	public 	$request;

	function __construct($options = []){
		$this->componentName = $this->parseComponentName();
		$this->initOptions   = $options;

		$this->initRouts();	

		$this->request = CMSRouter::apply($this);

		$custom_controller = CUSTOM_COMPONENTS.$this->componentName.'/controller/'.$this->request['controller'].'.php';
		$controller = COMPONENTS.$this->componentName.'/controller/'.$this->request['controller'].'.php';

		if (file_exists($custom_controller)){
			$this->load($custom_controller);
		} else if (file_exists($controller)){
			$this->load($controller);
		} else {
			throw new Exception("Controller not found", 1);
			
		}
	} 

	private function load($controller_path){
		include($controller_path);

		$class = new $this->request['controller']($this);
		$act = ($this->request['action'] ? $this->request['action'] : 'e404').'_action';

		if(method_exists($class,$act)){
			$class->$act();
		}

	}

	private function parseComponentName(){
		return lcfirst(str_replace ('CMS','',get_class($this)));
	}

	private function initRouts(){
		$custom_routs = CUSTOM_COMPONENTS.$this->componentName.'/routs.php';
		$routs = COMPONENTS.$this->componentName.'/routs.php';

		if (file_exists($routs)){
			$this->routs = include($routs);
		}

		if (file_exists($custom_routs)){
			$this->routs = array_merge($this->routs,include($custom_routs));
		}
	}

	private function route(){

	}

	public function render(){

	}
}