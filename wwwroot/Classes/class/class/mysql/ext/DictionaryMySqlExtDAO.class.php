<?php
/**
 * Class that operate on table 'dictionary'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-05-11 10:26
 */
class DictionaryMySqlExtDAO extends DictionaryMySqlDAO{
	public function queryByLangCodeKey($langCode,$key) {
		$sql = 'SELECT * FROM dictionary WHERE langCode=? AND `key`=?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($langCode);
		$sqlQuery->set($key);
		return $this->getRow($sqlQuery);
	}
	
}
?>