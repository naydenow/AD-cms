<?php 

class cms_core_CMSComponentController extends ad_controller {

	public  $component;
	private  $public_path;

	function __construct($name,$dir,$component) {
		parent::__construct($name,$dir);

		$this->component = $component;

		$this->public_path = '/static/'.$component->componentName.'/';

		/** TODO - создать кэш для статики */
		$path = $dir.'/viewer/public/';

		if (file_exists($path)){
			$public = _PUBLIC.'/static/'.$component->componentName.'/';
			if (!file_exists($public)){
				mkdir($public,0777);
				$this->copydirect($path,$public);
			}
		}
	}

	public function path(){
		return $this->public_path;
	}

	public function table($tname){
		$p = COMPONENTS.$this->component->componentName.'/table/'.$tname.'.php';

		if (file_exists($p)){
			include_once($p);

			return new $tname;
		}
		
		return $p;
		
	}




	private function copydirect($source, $dest, $over=false){
	    if(!is_dir($dest))
	        mkdir($dest);
	    if($handle = opendir($source))
	    {
	        while(false !== ($file = readdir($handle)))
	        {
	            if($file != '.' && $file != '..')
	            {
	                $path = $source . '/' . $file;
	                if(is_file($path))
	                {
	                    if(!is_file($dest . '/' . $file || $over))
	                        if(!@copy($path, $dest . '/' . $file))
	                        {
	                            echo "('.$path.') Ошибка!!! ";
	                        }
	                }
	                elseif(is_dir($path))
	                {
	                    if(!is_dir($dest . '/' . $file))
	                        mkdir($dest . '/' . $file);
	                    $this->copydirect($path, $dest . '/' . $file, $over);
	                }
	            }
	        }
	        closedir($handle);
	    }
	}
}