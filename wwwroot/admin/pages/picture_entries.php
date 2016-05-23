<?php
include_once '../../Classes/include_dao.php';

$artists = DAOFactory::getArtistDAO()->all();
$artistId = isset($_GET["id"])?$_GET["id"]:0;
if (isset($artistId) && $artistId > 0) {
	$pictures = DAOFactory::getPictureDAO()->queryByArtist($artistId);
} else {
	$pictures = DAOFactory::getPictureDAO()->queryAll();
}
?>
<div class="row">
<?php foreach ($pictures as $picture) { ?>
	<div class="picture-element">
		<a href="#detail" data-id="<?php echo $picture->id?>" class="nav detail">
			<img alt="<?php echo $picture->name?>" src="<?php echo isset($picture->thPath)?$picture->thPath:$picture->path ?>" />
			<p><?php echo $picture->name?></p>
			<p><?php echo $picture->price?></p>
		</a>
	</div>
<?php }?>
</div>