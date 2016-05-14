<?php
/**
 * Class that operate on table 'artist'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-09 11:52
 */
class ArtistMySqlExtDAO extends ArtistMySqlDAO{
	/**
	 * Get all artists by pictureId
	 */
	public function queryByPicture($pictureId) {
		$sql = 'SELECT a.* FROM artist_picture ap INNER JOIN artist a ON a.id = ap.artist_id WHERE ap.picture_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($pictureId);
	
		return $this->getList($sqlQuery);
	}
	
	public function all() {
		$sql = "SELECT * FROM artist WHERE deletedDate='0000-00-00' OR deletedDate < CURDATE()";
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
}
?>