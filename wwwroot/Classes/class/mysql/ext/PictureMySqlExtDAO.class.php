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
	
}
?>