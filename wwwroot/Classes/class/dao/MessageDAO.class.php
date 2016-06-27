<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 14:34
 */
interface MessageDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Message 
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
 	 * @param message primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Message message
 	 */
	public function insert($message);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Message message
 	 */
	public function update($message);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByCreatedDate($value);

	public function queryByName($value);

	public function queryByEmail($value);

	public function queryBySubject($value);

	public function queryByMessage($value);

	public function queryByStatus($value);


	public function deleteByCreatedDate($value);

	public function deleteByName($value);

	public function deleteByEmail($value);

	public function deleteBySubject($value);

	public function deleteByMessage($value);

	public function deleteByStatus($value);


}
?>