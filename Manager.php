<?php
namespace cms;


define('CMS_ROOT', AD.'/../cms/');
define('COMPONENTS', CMS_ROOT.'сomponents/');
define('CUSTOM_COMPONENTS', ROOT.'../сomponents/');

class Manager {
	static private 	 $classCache = [];
	static protected $router;
	static private $inited = false;

	static function init(){
		if (self::$inited)
			return;

		self::$inited = true;

		core\CMSRouter::init();
	}

	static public function initComponent($name, $options = [])  { 
		self::init();

		$class_name = 'CMS'.ucfirst($name);
		

		if (empty(self::$classCache[$class_name])){
			if (file_exists(COMPONENTS.$name)){
				$path = COMPONENTS.$name;
				include_once($path.'/index.php');
				self::$classCache[$class_name] = $class_name;
			} else if (file_exists(CUSTOM_COMPONENTS.$name)){
				$path = CUSTOM_COMPONENTS.$name;
				include_once($path .'/index.php');
				self::$classCache[$class_name] = $class_name;
			} else {
				throw new Exception("Component not found: ".$class_name, 1);
			}
		}

		return new self::$classCache[$class_name]($options, $path);
	}

	static public function clearCache(){
		self::$classCache = [];
	}

}