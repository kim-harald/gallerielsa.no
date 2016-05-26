<?php
/**
 * Class that operate on table 'picture'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-09 11:52
 */
class PictureMySqlExtDAO extends PictureMySqlDAO{
	/**
	 * Get all pictures by artist
	 */
	public function queryByArtist($artistId) {
		$sql = 'SELECT p.* FROM picture p WHERE p.artist_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($artistId);
	
		return $this->getList($sqlQuery);
	}
	
	public function queryByExhibition($exhibitionId) {
		$sql = 'SELECT p.* FROM picture p '.
		'INNER JOIN exhibition_picture ep ON ep.picture_id = p.id ' .
		'WHERE ep.exhibition_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);
		
		return $this->getList($sqlQuery);
	}
	
	public function queryAvailablePictures($exhibitionId) {
		$sql = 'SELECT p.* FROM picture p '.
				'WHERE p.id NOT IN ' .
				'(SELECT picture_id FROM exhibition_picture WHERE exhibition_id = ?)';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);
		
		return $this->getList($sqlQuery);
	}
	
}
?>