<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-07 14:34
 */
interface ExhibitionPictureDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ExhibitionPicture 
	 */
	public function load($exhibitionId, $pictureId);

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
 	 * @param exhibitionPicture primary key
 	 */
	public function delete($exhibitionId, $pictureId);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ExhibitionPicture exhibitionPicture
 	 */
	public function insert($exhibitionPicture);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ExhibitionPicture exhibitionPicture
 	 */
	public function update($exhibitionPicture);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByOrderNo($value);


	public function deleteByOrderNo($value);


}
?>