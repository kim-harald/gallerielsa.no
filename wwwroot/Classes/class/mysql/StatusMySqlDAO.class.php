<?php
/**
 * Class that operate on table 'status'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-19 22:45
 */
class StatusMySqlDAO implements StatusDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return StatusMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM status WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM status';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM status ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param statu primary key
 	 */
	public function delete($status){
		$sql = 'DELETE FROM status WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($status);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param StatusMySql statu
 	 */
	public function insert($statu){
		$sql = 'INSERT INTO status (description) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($statu->description);

		$id = $this->executeInsert($sqlQuery);	
		$statu->status = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param StatusMySql statu
 	 */
	public function update($statu){
		$sql = 'UPDATE status SET description = ? WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($statu->description);

		$sqlQuery->set($statu->status);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM status';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescription($value){
		$sql = 'SELECT * FROM status WHERE description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescription($value){
		$sql = 'DELETE FROM status WHERE description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return StatusMySql 
	 */
	protected function readRow($row){
		$statu = new Statu();
		
		$statu->status = $row['status'];
		$statu->description = $row['description'];

		return $statu;
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
	 * @return StatusMySql 
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