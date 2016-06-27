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
		$sql = 	"SELECT a . * , ap.cnt, ap.path, ap.thPath " .
						"FROM artist a " .
						"LEFT JOIN ( ".
							"SELECT COUNT( 1 )  `cnt` , MIN( p.path )  `path` , MIN( p.thPath )  `thPath` , p.artistid " .
							"FROM picture p " .
							"GROUP BY p.artistid " .
						") ap ON ap.artistid = a.id " .
						"WHERE deletedDate =  '0000-00-00' OR NOW( ) < deletedDate";
		$sqlQuery = new SqlQuery($sql);
		return $this->getList1($sqlQuery);
	}
	
	public function remove($artist) {
		$sql = 'UPDATE artist SET deletedDate = ? WHERE id = ?';

		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($artist->deletedDate);
		$sqlQuery->setNumber($artist->id);
		
		return $this->executeUpdate($sqlQuery);
	}
	
	private function getList1($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
	
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow1($tab[$i]);
		}
	
		return $ret;
	}
	
	private function readRow1($row){
		$a = new ArtistExtra();
	
		$a->id = $row['id'];
		$a->firstname = $row['Firstname'];
		$a->lastname= $row['Lastname'];
		$a->shortDescr = $row['shortDescr'];
		$a->longDescr = $row['longDescr'];
		$a->profilePicturePath = $row['profile_picture_path'];
		$a->picturePath = $row['path'];
		$a->thPicturePath = $row['thPath'];
		$a->name = $row['name'];
		$a->createdDate = $row['createdDate'];
		$a->deletedDate= $row['deletedDate'];
		$a->numPictures= $row['cnt'];
	
		return $a;
	}
}
?>