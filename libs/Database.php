<?php
/*
Author: Francis Lagazon
*/
class Database extends PDO
{
	
	public function __construct() {
		parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
	}
	
	/* 
	Function Select Statement
	$db->select("SELECT * FROM `table` WHERE `column1` = ''");
	
	*/
	public function select($sql, $fetchMode = PDO::FETCH_ASSOC) {
		
		$sth = $this->prepare($sql);
		$result = $sth->execute();
		return($sth->fetchAll($fetchMode));
		
	}
	/* 
	Function Insert Statement
	$db->add('table', array('column1' => "", 'column2' => ""))
	
	*/
	public function add($table, $data) {
		ksort($data);
		
		$fieldName = implode("`, `", array_keys($data));
		$fieldData = ":".implode(", :", array_keys($data));
		$sth = $this->prepare("INSERT INTO $table(`$fieldName`) VALUES($fieldData)");
		
		foreach($data as $key => $value){
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
	}
	/* 
	Function Update Statement
	$db->edit('table', array('column1' => "", 'column2' => ""),"`column3` = ''")
	
	*/
	public function edit($table, $data, $where) {
		ksort($data);
		$setData = null;
		foreach($data as $key => $values){
			$setData .= "`$key`=:$key,";
		}
		$setData = rtrim($setData, ",");
		$sth = $this->prepare("UPDATE $table SET $setData WHERE $where");
		
		foreach($data as $key => $value){
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
	}
	/* 
	Function Delete Statement
	$db->delete('table',"`column1` = '');
	
	*/
	public function delete($table, $where, $limit = 1) {
		$sth = $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
	}
	
}