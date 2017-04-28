<?php 

define("COLLECTION_PATH", ROOT . 'collection/');


class collection extends cms_core_CMSComponentController {

	public function index_action(){ 
		$this->setTemplate('main');
		$files = scandir(COLLECTION_PATH);
		$collections = [];

		foreach ($files as $file) {
			if ($file != '.' && $file != '..'){
				$cfile     = preg_replace('/\.php/', '', $file) ;
				$className = "collection_$cfile";
				$rows      = $this->table('collections')->getRowsCount($className);

				$collections[] = [
					'name'  =>$cfile,
					'class' =>$className,
					'docs'  =>$rows 
				];
			}
		}

		$this->view(['bread_crumbs'=>['title'=>'Collection'],'data'=>$collections],'collection')->render();
	}
	

	public function edit_action(){
		$name = AD::request('edit');
		$cname = 'collection_'.$name;

		$c = $this->$cname();
		if (!$c)
			return $this->header('/admin/collection/new');

		$column = $c->getColumn();
		$this->setTemplate('main');

		$this->view(['bread_crumbs'=>['title'=>"Collection \\ $name"],'data' => ['column' => $column , 'name' =>$name]],'collection_new')->render();

	}
	
	public function new_action(){ 
		$this->setTemplate('main');
		$this->view(['bread_crumbs'=>['title'=>'Collection'],'data'=>[]],'collection_new')->render();
	}


	public function create_action(){ 
		$post   = AD::post();
		$name   = $post['name'];
		$action = 'create';

		if(!$name)
			return $this->json(['err'=>'name'])->render();

		$path = COLLECTION_PATH.$name.'.php';

		if (file_exists($path)){
			$action = 'update';
		}

		$ColumnNames = 'columnNames';

		if($this->table('collections')->$action($post)){
			$cn = [];

		 	foreach ($post['column'] as $column) {
		 		$cname = $column[0];
		 		$ctype = $column[1];
		 		$deff = $column[2];

				$cn[] =  "'$cname' => ['type' => '$ctype','default' => '$deff']";
		 	}

			file_put_contents($path,"<?php class collection_$name extends ad_orm {
				protected $$ColumnNames = [".implode(',',$cn)."];
			}");
		} 
		
		return $this->json(['res'=>'ok'])->render();
	}



	public function open_action(){ 
		$name = AD::request('open');

		if(!$name)
			return $this->header('/admin/collection/');

		$this->setTemplate('main');

		$collectionName = "collection_$name";

		$collection = $this->$collectionName();
		$columns = $collection->getColumn();
		$res = (array)$collection::pagination();

		$this->view(['bread_crumbs'=>['title'=>$collectionName],'data'=> [$res, $columns,$name]], 'collection_open'  )->render();

	}

	public function remove_action(){
		$name = AD::request('remove');
		$cname = 'collection_'.$name;

		$c = $this->$cname();

		if (!$c)
			return $this->header('/admin/collection/');

		$c::drop();

		unlink(COLLECTION_PATH.$name.'.php');

		return $this->header('/admin/collection/');
	}



}
