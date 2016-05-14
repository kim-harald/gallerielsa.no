<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-05-11 22:07
 */
interface DictionaryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Dictionary 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param dictionary primary key
 	 */
	public function delete($langCode);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Dictionary dictionary
 	 */
	public function insert($dictionary);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Dictionary dictionary
 	 */
	public function update($dictionary);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByKey($value);

	public function queryByValue($value);


	public function deleteByKey($value);

	public function deleteByValue($value);


}
?>