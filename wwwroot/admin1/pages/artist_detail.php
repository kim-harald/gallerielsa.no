<?php 
	include_once '../../classes/include_dao.php';
	$artistId = $_REQUEST["artistid"];
	$artist = new Artist();
	$artist = DAOFactory::getArtistDAO()->load($artistId);
?>
<div class="ui_content" data-id="<?php echo $artistId;?>">
        <p><?php echo $artist->name;?></p>
        <p><?php echo $artist->shortDescr;?></p>
        <p><?php echo $artist->longDescr;?></p>
        <a href="#edit" class="btn"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="#main" class="btn"><span class="glyphicon glyphicon-chevron-left"></span></a>
</div>