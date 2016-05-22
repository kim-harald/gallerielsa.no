<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-05-19 22:46
 */
interface PictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Picture 
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
 	 * @param picture primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Picture picture
 	 */
	public function insert($picture);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Picture picture
 	 */
	public function update($picture);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByArtistid($value);

	public function queryByRefid($value);

	public function queryByName($value);

	public function queryByPath($value);

	public function queryByDateCreated($value);

	public function queryByDateDisplayed($value);

	public function queryByDateRemoved($value);

	public function queryByKeywords($value);

	public function queryByStatus($value);

	public function queryByShortDescr($value);

	public function queryByLongDescr($value);

	public function queryByPrice($value);

	public function queryByDimensions($value);


	public function deleteByArtistid($value);

	public function deleteByRefid($value);

	public function deleteByName($value);

	public function deleteByPath($value);

	public function deleteByDateCreated($value);

	public function deleteByDateDisplayed($value);

	public function deleteByDateRemoved($value);

	public function deleteByKeywords($value);

	public function deleteByStatus($value);

	public function deleteByShortDescr($value);

	public function deleteByLongDescr($value);

	public function deleteByPrice($value);

	public function deleteByDimensions($value);


}
?>