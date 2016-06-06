<?php
/**
 * Class that operate on table 'blog'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-19 22:45
 */
class BlogMySqlExtDAO extends BlogMySqlDAO{
	public function queryGetCurrentFuture($orderColumn){
		$sql = 'SELECT * FROM blog WHERE endDate >= now() '.
				'ORDER BY '.$orderColumn;
	
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
}
?>