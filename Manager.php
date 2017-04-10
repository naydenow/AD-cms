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

		$componentIndexFile = COMPONENTS.$name.'/index.php';

		$name = 'CMS'.ucfirst($name);

		if (empty(self::$classCache[$name])){
			if (file_exists($componentIndexFile)){

				include_once($componentIndexFile);


				self::$classCache[$name] = $name;

			} else {
				throw new Exception("Component not found: ".$name, 1);
			}
		}

		return new self::$classCache[$name]($options);
	}

	static public function clearCache(){
		self::$classCache = [];
	}

}