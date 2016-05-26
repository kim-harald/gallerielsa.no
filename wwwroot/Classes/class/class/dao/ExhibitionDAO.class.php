<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-05-23 11:34
 */
interface ExhibitionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Exhibition 
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
 	 * @param exhibition primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Exhibition exhibition
 	 */
	public function insert($exhibition);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Exhibition exhibition
 	 */
	public function update($exhibition);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByStartDate($value);

	public function queryByEndDate($value);


	public function deleteByName($value);

	public function deleteByStartDate($value);

	public function deleteByEndDate($value);


}
?>