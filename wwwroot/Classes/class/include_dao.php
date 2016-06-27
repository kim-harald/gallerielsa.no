<?php
	//include all DAO files
	require_once('class/sql/Connection.class.php');
	require_once('class/sql/ConnectionFactory.class.php');
	require_once('class/sql/ConnectionProperty.class.php');
	require_once('class/sql/QueryExecutor.class.php');
	require_once('class/sql/Transaction.class.php');
	require_once('class/sql/SqlQuery.class.php');
	require_once('class/core/ArrayList.class.php');
	require_once('class/dao/DAOFactory.class.php');
 	
	require_once('class/dao/ArtistDAO.class.php');
	require_once('class/dto/Artist.class.php');
	require_once('class/dto/ext/ArtistExt.class.php');
	require_once('class/mysql/ArtistMySqlDAO.class.php');
	require_once('class/mysql/ext/ArtistMySqlExtDAO.class.php');
	require_once('class/dao/ArtistPictureDAO.class.php');
	require_once('class/dto/ArtistPicture.class.php');
	require_once('class/mysql/ArtistPictureMySqlDAO.class.php');
	require_once('class/mysql/ext/ArtistPictureMySqlExtDAO.class.php');
	require_once('class/dao/BlogDAO.class.php');
	require_once('class/dto/Blog.class.php');
	require_once('class/mysql/BlogMySqlDAO.class.php');
	require_once('class/mysql/ext/BlogMySqlExtDAO.class.php');
	require_once('class/dao/DictionaryDAO.class.php');
	require_once('class/dto/Dictionary.class.php');
	require_once('class/mysql/DictionaryMySqlDAO.class.php');
	require_once('class/mysql/ext/DictionaryMySqlExtDAO.class.php');
	require_once('class/dao/ExhibitionDAO.class.php');
	require_once('class/dto/Exhibition.class.php');
	require_once('class/mysql/ExhibitionMySqlDAO.class.php');
	require_once('class/mysql/ext/ExhibitionMySqlExtDAO.class.php');
	require_once('class/dao/ExhibitionPictureDAO.class.php');
	require_once('class/dto/ExhibitionPicture.class.php');
	require_once('class/mysql/ExhibitionPictureMySqlDAO.class.php');
	require_once('class/mysql/ext/ExhibitionPictureMySqlExtDAO.class.php');
	require_once('class/dao/PictureDAO.class.php');
	require_once('class/dto/Picture.class.php');
	require_once('class/mysql/PictureMySqlDAO.class.php');
	require_once('class/mysql/ext/PictureMySqlExtDAO.class.php');
	require_once('class/dao/StatusDAO.class.php');
	require_once('class/dto/Statu.class.php');
	require_once('class/mysql/StatusMySqlDAO.class.php');
	require_once('class/mysql/ext/StatusMySqlExtDAO.class.php');
	

?>