<?php
/**
 * Class that operate on table 'dictionary'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 13:42
 */
class DictionaryMySqlDAO implements DictionaryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return DictionaryMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM dictionary WHERE langCode = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM dictionary';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM dictionary ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param dictionary primary key
 	 */
	public function delete($langCode){
		$sql = 'DELETE FROM dictionary WHERE langCode = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($langCode);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param DictionaryMySql dictionary
 	 */
	public function insert($dictionary){
		$sql = 'INSERT INTO dictionary (key, value) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($dictionary->key);
		$sqlQuery->set($dictionary->value);

		$id = $this->executeInsert($sqlQuery);	
		$dictionary->langCode = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param DictionaryMySql dictionary
 	 */
	public function update($dictionary){
		$sql = 'UPDATE dictionary SET key = ?, value = ? WHERE langCode = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($dictionary->key);
		$sqlQuery->set($dictionary->value);

		$sqlQuery->set($dictionary->langCode);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM dictionary';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByKey($value){
		$sql = 'SELECT * FROM dictionary WHERE key = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByValue($value){
		$sql = 'SELECT * FROM dictionary WHERE value = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByKey($value){
		$sql = 'DELETE FROM dictionary WHERE key = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByValue($value){
		$sql = 'DELETE FROM dictionary WHERE value = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return DictionaryMySql 
	 */
	protected function readRow($row){
		$dictionary = new Dictionary();
		
		$dictionary->langCode = $row['langCode'];
		$dictionary->key = $row['key'];
		$dictionary->value = $row['value'];

		return $dictionary;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return DictionaryMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>