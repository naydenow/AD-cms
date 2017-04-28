<?php

namespace cms\core;

class CMSComponent {
	public  $routs;
	public  $componentName;
	public  $initOptions;
	public 	$request;
	public  $path;

	function __construct($options = [], $path){
		$this->path = $path;
		$this->componentName = $this->parseComponentName();
		$this->initOptions   = $options;
		$this->initRouts();	
		$this->request = CMSRouter::apply($this);

		if (empty($this->request['controller']))
			$this->request['controller'] = 'index';

		if (empty($this->request['action']))
			$this->request['action'] = 'index';

		//$custom_controller = CUSTOM_COMPONENTS.$this->componentName.'/controller/'.$this->request['controller'].'.php';
		//
		$controller = $this->path.'/controller/'.$this->request['controller'].'.php';


		if (file_exists($controller)){
			$this->load($controller, COMPONENTS.$this->componentName);
		} else {
			echo("Controller not found");
		}
	} 

	private function load($controller_path){

		include($controller_path);

		$class = new $this->request['controller']($this->request['controller'], $this->path, $this);
		$act = ($this->request['action'] ? $this->request['action'] : 'e404').'_action';

		if(method_exists($class,$act)){
			$class->$act();
		}

	}

	private function parseComponentName(){
		return lcfirst(str_replace ('CMS','',get_class($this)));
	}

	private function initRouts(){
		$routs = $this->path.'/routs.php';

		if (file_exists($routs)){
			$this->routs = include($routs);
		}
	}

	private function route(){

	}

	public function render(){

	}
}