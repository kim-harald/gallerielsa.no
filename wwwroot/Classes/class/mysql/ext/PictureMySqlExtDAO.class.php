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
		$sql = 'SELECT p.* FROM artist_picture ap	INNER JOIN picture p ON p.id = ap.picture_Id WHERE ap.artist_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($artistId);
	
		return $this->getList($sqlQuery);
	}
	
	public function all() {
		$sql = "SELECT * FROM picture WHERE deletedDate='0000-00-00' OR NOW() < deletedDate";
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
}
?>