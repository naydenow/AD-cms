<?php

namespace cms\core;

class CMSRouter {
	static protected $uri;
	static protected $path;

	static public function init(){
		self::$uri = $_SERVER['REQUEST_URI'];

		if (self::$uri  != '/') {
			$url_path = parse_url(self::$uri , PHP_URL_PATH);
			$url_path = trim($url_path,'/');
		}

		self::$path = $url_path;
	}

	

	static public function apply(CMSComponent $component){
		$masp = [];

		$component_uri = preg_replace('/'.$component->componentName.'\//i', '', self::$path,1);  


		if (!empty($component->routs[$component_uri])){
			$component_uri = $component->routs[$component_uri];
		} else {
			foreach ($component->routs as $key => $value) {
				$st = strpos($key,'*'); 
				if($st !== false){//Звёздачка в роуте есть
					if(substr($component_uri,0,$st)."*" == $key){
						$component_uri = $value.'/'.substr($component_uri,$st,9999);
						break;
					}
				}
			}
		}

		$qwer = array();
		$component_uri = explode('/', trim($component_uri, ' /'));
		$co =  count($component_uri);



		if ($co >= 1 && $component_uri[0] != ''){
			$masp['controller'] = $component_uri[0];
		}

		if ($co >= 2){
			$masp['controller'] = $component_uri[0];
			$masp['action'] 	= $component_uri[1];
		}

		if ($co === 3){
			$masp['id'] 	= $component_uri[2];
			$qwer['*'] 		= $component_uri[2];
		}

		if ($co > 3 ){
			$o = 2;
			$cp = count($component_uri)-1;
			while($cp > $o){
				$qwer[$component_uri[$o++]] = $component_uri[$o++];
			}
		}

		if (!empty($qwer)){
			$masp['request'] = $qwer;
		}

		return $masp;
	}


}