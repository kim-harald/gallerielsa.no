<?php
/**
 * Class that operate on table 'artist'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-26 12:01
 */
class ArtistMySqlDAO implements ArtistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ArtistMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM artist WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM artist';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM artist ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param artist primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM artist WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ArtistMySql artist
 	 */
	public function insert($artist){
		$sql = 'INSERT INTO artist (name, shortDescr, longDescr, profile_picture_path, jsonData, createdDate, deletedDate) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($artist->name);
		$sqlQuery->set($artist->shortDescr);
		$sqlQuery->set($artist->longDescr);
		$sqlQuery->set($artist->profilePicturePath);
		$sqlQuery->set($artist->jsonData);
		$sqlQuery->set($artist->createdDate);
		$sqlQuery->set($artist->deletedDate);

		$id = $this->executeInsert($sqlQuery);	
		$artist->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ArtistMySql artist
 	 */
	public function update($artist){
		$sql = 'UPDATE artist SET name = ?, shortDescr = ?, longDescr = ?, profile_picture_path = ?, jsonData = ?, createdDate = ?, deletedDate = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($artist->name);
		$sqlQuery->set($artist->shortDescr);
		$sqlQuery->set($artist->longDescr);
		$sqlQuery->set($artist->profilePicturePath);
		$sqlQuery->set($artist->jsonData);
		$sqlQuery->set($artist->createdDate);
		$sqlQuery->set($artist->deletedDate);

		$sqlQuery->setNumber($artist->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM artist';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM artist WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByShortDescr($value){
		$sql = 'SELECT * FROM artist WHERE shortDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLongDescr($value){
		$sql = 'SELECT * FROM artist WHERE longDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProfilePicturePath($value){
		$sql = 'SELECT * FROM artist WHERE profile_picture_path = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByJsonData($value){
		$sql = 'SELECT * FROM artist WHERE jsonData = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCreatedDate($value){
		$sql = 'SELECT * FROM artist WHERE createdDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDeletedDate($value){
		$sql = 'SELECT * FROM artist WHERE deletedDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM artist WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByShortDescr($value){
		$sql = 'DELETE FROM artist WHERE shortDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLongDescr($value){
		$sql = 'DELETE FROM artist WHERE longDescr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProfilePicturePath($value){
		$sql = 'DELETE FROM artist WHERE profile_picture_path = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByJsonData($value){
		$sql = 'DELETE FROM artist WHERE jsonData = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCreatedDate($value){
		$sql = 'DELETE FROM artist WHERE createdDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDeletedDate($value){
		$sql = 'DELETE FROM artist WHERE deletedDate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ArtistMySql 
	 */
	protected function readRow($row){
		$artist = new Artist();
		
		$artist->id = $row['id'];
		$artist->name = $row['name'];
		$artist->shortDescr = $row['shortDescr'];
		$artist->longDescr = $row['longDescr'];
		$artist->profilePicturePath = $row['profile_picture_path'];
		$artist->jsonData = $row['jsonData'];
		$artist->createdDate = $row['createdDate'];
		$artist->deletedDate = $row['deletedDate'];

		return $artist;
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
	 * @return ArtistMySql 
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