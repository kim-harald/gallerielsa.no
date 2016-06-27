<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 14:34
 */
interface BlogDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Blog 
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
 	 * @param blog primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Blog blog
 	 */
	public function insert($blog);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Blog blog
 	 */
	public function update($blog);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);

	public function queryByMessage($value);

	public function queryByStartDate($value);

	public function queryByEndDate($value);


	public function deleteByTitle($value);

	public function deleteByMessage($value);

	public function deleteByStartDate($value);

	public function deleteByEndDate($value);


}
?>