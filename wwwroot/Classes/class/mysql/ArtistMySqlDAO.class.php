<?php
/**
 * Class that operate on table 'artist'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 13:42
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
		$sql = 'INSERT INTO artist (name, Firstname, Lastname, shortDescr, longDescr, profile_picture_path, createdDate, deletedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($artist->name);
		$sqlQuery->set($artist->firstname);
		$sqlQuery->set($artist->lastname);
		$sqlQuery->set($artist->shortDescr);
		$sqlQuery->set($artist->longDescr);
		$sqlQuery->set($artist->profilePicturePath);
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
		$sql = 'UPDATE artist SET name = ?, Firstname = ?, Lastname = ?, shortDescr = ?, longDescr = ?, profile_picture_path = ?, createdDate = ?, deletedDate = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($artist->name);
		$sqlQuery->set($artist->firstname);
		$sqlQuery->set($artist->lastname);
		$sqlQuery->set($artist->shortDescr);
		$sqlQuery->set($artist->longDescr);
		$sqlQuery->set($artist->profilePicturePath);
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

	public function queryByFirstname($value){
		$sql = 'SELECT * FROM artist WHERE Firstname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLastname($value){
		$sql = 'SELECT * FROM artist WHERE Lastname = ?';
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

	public function deleteByFirstname($value){
		$sql = 'DELETE FROM artist WHERE Firstname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLastname($value){
		$sql = 'DELETE FROM artist WHERE Lastname = ?';
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
		$artist->firstname = $row['Firstname'];
		$artist->lastname = $row['Lastname'];
		$artist->shortDescr = $row['shortDescr'];
		$artist->longDescr = $row['longDescr'];
		$artist->profilePicturePath = $row['profile_picture_path'];
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