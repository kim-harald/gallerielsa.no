<?php
/**
 * Class that operate on table 'exhibition'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-09 11:52
 */
class ExhibitionMySqlExtDAO extends ExhibitionMySqlDAO{
	
	public function queryExhibitionPictures($exhibitionId) {
		$sql = "SELECT p.*,ep.exhibition_id FROM exhibition_picture ep INNER JOIN picture p ON p.id = ep.picture_id WHERE ep.exhibition_id =?;";
		
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($exhibitionId);
		
		return $this->getList1($sqlQuery);
	}
	
	public function queryGetCurrentFuture($orderColumn){
		$sql = 'SELECT exh.id,exh.name,exh.startDate,exh.endDate, ' .
		  '(SELECT COUNT(1) FROM exhibition_picture '. 
		  'WHERE exhibition_id=exh.id '.
		  ') longDescr ' .  
		  'FROM exhibition exh WHERE endDate >= now() ' . 
			'ORDER BY '.$orderColumn;

		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function queryGetCurrentFutureDescr($orderColumn){
		$sql = 'SELECT exh.id,exh.name,exh.startDate,exh.endDate, exh.longDescr ' .
				'FROM exhibition exh WHERE endDate >= now() ' .
				'ORDER BY '.$orderColumn;
	
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
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
		$exhp = new PictureExhibition();
		
		$exhp->id = $row['id'];
		$exhp->artistid = $row['artistid'];
		$exhp->refid = $row['refid'];
		$exhp->name = $row['name'];
		$exhp->path = $row['path'];
		$exhp->dateCreated = $row['dateCreated'];
		$exhp->dateDisplayed = $row['dateDisplayed'];
		$exhp->dateRemoved = $row['dateRemoved'];
		$exhp->keywords = $row['keywords'];
		$exhp->status = $row['status'];
		$exhp->shortDescr = $row['shortDescr'];
		$exhp->longDescr = $row['longDescr'];
		$exhp->price = $row['price'];
		$exhp->aspect = $row['aspect'];
		$exhp->exhibitionId = $row['exhibition_id'];
		
		return $exhp;
	}
	
}

class PictureExhibition {
	var $exhibitionId;
	
	var $id;
	
	var $artistid;
	
	var $refid;
	
	var $name;
	
	var $path;
	
	var $dateCreated;
	
	var $dateDisplayed;
	
	var $dateRemoved;
	
	var $keywords;
	
	var $status;
	
	var $shortDescr;
	
	var $longDescr;
	
	var $price;
	
	var $aspect;
}
?>