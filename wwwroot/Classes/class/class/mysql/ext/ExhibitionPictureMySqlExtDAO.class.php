<?php
/**
 * Class that operate on table 'exhibition_picture'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-09 11:52
 */
class ExhibitionPictureMySqlExtDAO extends ExhibitionPictureMySqlDAO{
	public function queryByExhibition($exhibitionId) {
		$sql = 'SELECT * FROM exhibition_picture WHERE exhibitionid=?';
		
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);

		return $this->getList($sqlQuery);
	}
	
}
?>