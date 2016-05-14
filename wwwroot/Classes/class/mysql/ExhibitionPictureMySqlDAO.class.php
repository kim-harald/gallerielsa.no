<?php
/**
 * Class that operate on table 'exhibition_picture'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-11 22:06
 */
class ExhibitionPictureMySqlDAO implements ExhibitionPictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ExhibitionPictureMySql 
	 */
	public function load($exhibitionId, $pictureId){
		$sql = 'SELECT * FROM exhibition_picture WHERE exhibition_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);
		$sqlQuery->setNumber($pictureId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM exhibition_picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM exhibition_picture ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param exhibitionPicture primary key
 	 */
	public function delete($exhibitionId, $pictureId){
		$sql = 'DELETE FROM exhibition_picture WHERE exhibition_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);
		$sqlQuery->setNumber($pictureId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ExhibitionPictureMySql exhibitionPicture
 	 */
	public function insert($exhibitionPicture){
		$sql = 'INSERT INTO exhibition_picture ( exhibition_id, picture_id) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($exhibitionPicture->exhibitionId);

		$sqlQuery->setNumber($exhibitionPicture->pictureId);

		$this->executeInsert($sqlQuery);	
		//$exhibitionPicture->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ExhibitionPictureMySql exhibitionPicture
 	 */
	public function update($exhibitionPicture){
		$sql = 'UPDATE exhibition_picture SET  WHERE exhibition_id = ?  AND picture_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($exhibitionPicture->exhibitionId);

		$sqlQuery->setNumber($exhibitionPicture->pictureId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM exhibition_picture';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return ExhibitionPictureMySql 
	 */
	protected function readRow($row){
		$exhibitionPicture = new ExhibitionPicture();
		
		$exhibitionPicture->exhibitionId = $row['exhibition_id'];
		$exhibitionPicture->pictureId = $row['picture_id'];

		return $exhibitionPicture;
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
	 * @return ExhibitionPictureMySql 
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