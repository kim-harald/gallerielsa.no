<?php
/**
 * Class that operate on table 'exhibition'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-11 22:06
 */
class ExhibitionMySqlDAO implements ExhibitionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ExhibitionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM exhibition WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM exhibition';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM exhibition ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param exhibition primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM exhibition WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ExhibitionMySql exhibition
 	 */
	public function insert($exhibition){
		$sql = 'INSERT INTO exhibition (name, startDate, endDate) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($exhibition->name);
		$sqlQuery->set($exhibition->startDate);
		$sqlQuery->set($exhibition->endDate);

		$id = $this->executeInsert($sqlQuery);	
		$exhibition->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ExhibitionMySql exhibition
 	 */
	public function update($exhibition){
		$sql = 'UPDATE exhibition SET name = ?, startDate = ?, endDate = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($exhibition->name);
		$sqlQuery->set($exhibition->startDate);
		$sqlQuery->set($exhibition->endDate);

		$sqlQuery->setNumber($exhibition->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM exhibition';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM exhibition WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStartDate($value){
		$sql = 'SELECT * FROM exhibition WHERE startDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndDate($value){
		$sql = 'SELECT * FROM exhibition WHERE endDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM exhibition WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStartDate($value){
		$sql = 'DELETE FROM exhibition WHERE startDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndDate($value){
		$sql = 'DELETE FROM exhibition WHERE endDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ExhibitionMySql 
	 */
	protected function readRow($row){
		$exhibition = new Exhibition();
		
		$exhibition->id = $row['id'];
		$exhibition->name = $row['name'];
		$exhibition->startDate = $row['startDate'];
		$exhibition->endDate = $row['endDate'];

		return $exhibition;
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
	 * @return ExhibitionMySql 
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