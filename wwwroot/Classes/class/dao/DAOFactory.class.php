<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return ArtistDAO
	 */
	public static function getArtistDAO(){
		return new ArtistMySqlExtDAO();
	}

	/**
	 * @return ArtistPictureDAO
	 */
	public static function getArtistPictureDAO(){
		return new ArtistPictureMySqlExtDAO();
	}

	/**
	 * @return BlogDAO
	 */
	public static function getBlogDAO(){
		return new BlogMySqlExtDAO();
	}

	/**
	 * @return DictionaryDAO
	 */
	public static function getDictionaryDAO(){
		return new DictionaryMySqlExtDAO();
	}

	/**
	 * @return ExhibitionDAO
	 */
	public static function getExhibitionDAO(){
		return new ExhibitionMySqlExtDAO();
	}

	/**
	 * @return ExhibitionPictureDAO
	 */
	public static function getExhibitionPictureDAO(){
		return new ExhibitionPictureMySqlExtDAO();
	}

	/**
	 * @return MessageDAO
	 */
	public static function getMessageDAO(){
		return new MessageMySqlExtDAO();
	}

	/**
	 * @return PictureDAO
	 */
	public static function getPictureDAO(){
		return new PictureMySqlExtDAO();
	}

	/**
	 * @return StatusDAO
	 */
	public static function getStatusDAO(){
		return new StatusMySqlExtDAO();
	}


}
?>