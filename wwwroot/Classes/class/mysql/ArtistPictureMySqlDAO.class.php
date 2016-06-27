<?php
/**
 * Class that operate on table 'artist_picture'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 14:34
 */
class ArtistPictureMySqlDAO implements ArtistPictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ArtistPictureMySql 
	 */
	public function load($artistId, $pictureId){
		$sql = 'SELECT * FROM artist_picture WHERE artist_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($artistId);
		$sqlQuery->setNumber($pictureId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM artist_picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM artist_picture ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param artistPicture primary key
 	 */
	public function delete($artistId, $pictureId){
		$sql = 'DELETE FROM artist_picture WHERE artist_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($artistId);
		$sqlQuery->setNumber($pictureId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ArtistPictureMySql artistPicture
 	 */
	public function insert($artistPicture){
		$sql = 'INSERT INTO artist_picture ( artist_id, picture_id) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($artistPicture->artistId);

		$sqlQuery->setNumber($artistPicture->pictureId);

		$this->executeInsert($sqlQuery);	
		//$artistPicture->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ArtistPictureMySql artistPicture
 	 */
	public function update($artistPicture){
		$sql = 'UPDATE artist_picture SET  WHERE artist_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($artistPicture->artistId);

		$sqlQuery->setNumber($artistPicture->pictureId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM artist_picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return ArtistPictureMySql 
	 */
	protected function readRow($row){
		$artistPicture = new ArtistPicture();
		
		$artistPicture->artistId = $row['artist_id'];
		$artistPicture->pictureId = $row['picture_id'];

		return $artistPicture;
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
	 * @return ArtistPictureMySql 
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