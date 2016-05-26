<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-05-23 11:34
 */
interface StatusDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Status 
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
 	 * @param statu primary key
 	 */
	public function delete($status);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Status statu
 	 */
	public function insert($statu);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Status statu
 	 */
	public function update($statu);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescription($value);


	public function deleteByDescription($value);


}
?>