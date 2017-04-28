<?php

class collections extends ad_table {

	private $types = [
		"Integer" 	=> "int(11) DEFAULT _DEF_",
		"Text" 		=> "text",
		"String" 	=> "varchar(255) DEFAULT _DEF_ ",
    "List"  => "varchar(255) DEFAULT _DEF_",
		"Timestamp" => "timestamp NULL DEFAULT CURRENT_TIMESTAMP"
	];

  private function getDef($type , $default = ' NULL') {
    if ($type === 'List' && $default !== 'NULL')
      $default = explode(',', $default)[0];


    return  preg_replace('/_DEF_/', "'$default'", $this->types[$type]);
  }

  //Выодим все совпадения
  public function create($data){
  	$query = "CREATE TABLE `collection_".$data['name']."` (
 				 `Id` int(11) NOT NULL AUTO_INCREMENT, ";

 	foreach ($data['column'] as $column) {
 		$name    = $column[0];
 		$type    = $column[1];
    $default = $column[2];

 		if ($name == 'Id')
 			continue;

		$query .=  "`".$name."` ".$this->getDef($type, $default).", ";
 	}

	$query .= "PRIMARY KEY (`Id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	return $this->query($query);

  }

  public function update($data){
    $table = "cms_collection_".$data['name'];

  }

  public function getRowsCount($table){
  	return $this->getOne('select count(*) as count from '.$table);
  }
}

/*

CREATE TABLE `cms_collection_news` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `er` varchar(255) DEFAULT NULL,
  `trt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/