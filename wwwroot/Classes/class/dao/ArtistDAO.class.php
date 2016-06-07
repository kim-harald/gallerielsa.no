<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 13:43
 */
interface ArtistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Artist 
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
 	 * @param artist primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Artist artist
 	 */
	public function insert($artist);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Artist artist
 	 */
	public function update($artist);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByFirstname($value);

	public function queryByLastname($value);

	public function queryByShortDescr($value);

	public function queryByLongDescr($value);

	public function queryByProfilePicturePath($value);

	public function queryByCreatedDate($value);

	public function queryByDeletedDate($value);


	public function deleteByName($value);

	public function deleteByFirstname($value);

	public function deleteByLastname($value);

	public function deleteByShortDescr($value);

	public function deleteByLongDescr($value);

	public function deleteByProfilePicturePath($value);

	public function deleteByCreatedDate($value);

	public function deleteByDeletedDate($value);


}
?>