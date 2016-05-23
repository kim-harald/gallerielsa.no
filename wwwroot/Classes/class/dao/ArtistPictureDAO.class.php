<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-05-23 11:34
 */
interface ArtistPictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ArtistPicture 
	 */
	public function load($artistId, $pictureId);

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
 	 * @param artistPicture primary key
 	 */
	public function delete($artistId, $pictureId);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ArtistPicture artistPicture
 	 */
	public function insert($artistPicture);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ArtistPicture artistPicture
 	 */
	public function update($artistPicture);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>