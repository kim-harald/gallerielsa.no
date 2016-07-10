<?php
include_once '../../Classes/include_dao.php';
include_once '../../utilities/common.php';
$id = isset($_GET["id"])?$_GET["id"]:0;

if ($id ==0) {
	die();
}

$picture = DAOFactory::getPictureDAO()->load($id);
$ts =time();
?>

<div class="picture-element">
		<a href="#detail?id=<?php echo $picture->id?>" data-id="<?php echo $picture->id?>" class="nav detail">
			<img class="thumbnail <?php echo isset($picture->aspect)?$picture->aspect:"landscape"?>" 
				alt='<?php echo $picture->name?>' 
				src="<?php echo (isset($picture->thPath)?$picture->thPath:$picture->path)."?ts=".$ts ?>" 
				data-id="<?php echo $picture->id?>" />
			<p><?php echo $picture->name?></p>
		</a>
</div>