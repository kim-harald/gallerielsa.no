<?php
/**
 * Class that operate on table 'picture'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-16 12:02
 */
class PictureMySqlDAO implements PictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PictureMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM picture WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM picture ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param picture primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM picture WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PictureMySql picture
 	 */
	public function insert($picture){
		$sql = 'INSERT INTO picture (refid, name, path, dateCreated, dateDisplayed, dateRemoved, keywords, status, shortDescr, longDescr, price, dimensions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($picture->refid);
		$sqlQuery->set($picture->name);
		$sqlQuery->set($picture->path);
		$sqlQuery->set($picture->dateCreated);
		$sqlQuery->set($picture->dateDisplayed);
		$sqlQuery->set($picture->dateRemoved);
		$sqlQuery->set($picture->keywords);
		$sqlQuery->set($picture->status);
		$sqlQuery->set($picture->shortDescr);
		$sqlQuery->set($picture->longDescr);
		$sqlQuery->set($picture->price);
		$sqlQuery->set($picture->dimensions);

		$id = $this->executeInsert($sqlQuery);	
		$picture->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PictureMySql picture
 	 */
	public function update($picture){
		$sql = 'UPDATE picture SET refid = ?, name = ?, path = ?, dateCreated = ?, dateDisplayed = ?, dateRemoved = ?, keywords = ?, status = ?, shortDescr = ?, longDescr = ?, price = ?, dimensions = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($picture->refid);
		$sqlQuery->set($picture->name);
		$sqlQuery->set($picture->path);
		$sqlQuery->set($picture->dateCreated);
		$sqlQuery->set($picture->dateDisplayed);
		$sqlQuery->set($picture->dateRemoved);
		$sqlQuery->set($picture->keywords);
		$sqlQuery->set($picture->status);
		$sqlQuery->set($picture->shortDescr);
		$sqlQuery->set($picture->longDescr);
		$sqlQuery->set($picture->price);
		$sqlQuery->set($picture->dimensions);

		$sqlQuery->setNumber($picture->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByRefid($value){
		$sql = 'SELECT * FROM picture WHERE refid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM picture WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPath($value){
		$sql = 'SELECT * FROM picture WHERE path = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDateCreated($value){
		$sql = 'SELECT * FROM picture WHERE dateCreated = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDateDisplayed($value){
		$sql = 'SELECT * FROM picture WHERE dateDisplayed = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDateRemoved($value){
		$sql = 'SELECT * FROM picture WHERE dateRemoved = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByKeywords($value){
		$sql = 'SELECT * FROM picture WHERE keywords = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStatus($value){
		$sql = 'SELECT * FROM picture WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByShortDescr($value){
		$sql = 'SELECT * FROM picture WHERE shortDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLongDescr($value){
		$sql = 'SELECT * FROM picture WHERE longDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPrice($value){
		$sql = 'SELECT * FROM picture WHERE price = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDimensions($value){
		$sql = 'SELECT * FROM picture WHERE dimensions = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRefid($value){
		$sql = 'DELETE FROM picture WHERE refid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByName($value){
		$sql = 'DELETE FROM picture WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPath($value){
		$sql = 'DELETE FROM picture WHERE path = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDateCreated($value){
		$sql = 'DELETE FROM picture WHERE dateCreated = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDateDisplayed($value){
		$sql = 'DELETE FROM picture WHERE dateDisplayed = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDateRemoved($value){
		$sql = 'DELETE FROM picture WHERE dateRemoved = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByKeywords($value){
		$sql = 'DELETE FROM picture WHERE keywords = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStatus($value){
		$sql = 'DELETE FROM picture WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByShortDescr($value){
		$sql = 'DELETE FROM picture WHERE shortDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLongDescr($value){
		$sql = 'DELETE FROM picture WHERE longDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPrice($value){
		$sql = 'DELETE FROM picture WHERE price = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDimensions($value){
		$sql = 'DELETE FROM picture WHERE dimensions = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PictureMySql 
	 */
	protected function readRow($row){
		$picture = new Picture();
		
		$picture->id = $row['id'];
		$picture->refid = $row['refid'];
		$picture->name = $row['name'];
		$picture->path = $row['path'];
		$picture->dateCreated = $row['dateCreated'];
		$picture->dateDisplayed = $row['dateDisplayed'];
		$picture->dateRemoved = $row['dateRemoved'];
		$picture->keywords = $row['keywords'];
		$picture->status = $row['status'];
		$picture->shortDescr = $row['shortDescr'];
		$picture->longDescr = $row['longDescr'];
		$picture->price = $row['price'];
		$picture->dimensions = $row['dimensions'];

		return $picture;
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
	 * @return PictureMySql 
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