<?php
include_once '../../Classes/include_dao.php';
include_once '../../utilities/common.php';
$id = isset($_GET["id"])?$_GET["id"]:0;

if ($id ==00) {
	die();
}

$picture = DAOFactory::getPictureDAO()->load($id);

?>


<div class="picture-element">
		<a href="#detail?id=<?php echo $picture->id?>" data-id="<?php echo $picture->id?>" class="nav detail">
			<div class="item-container">
				<div class="image-container">					
					<img class="thumbnail <?php echo isset($picture->aspect)?$picture->aspect:"landscape"?>" alt='<?php echo $picture->name?>' src="<?php echo isset($picture->thPath)?$picture->thPath:$picture->path ?>" />
				</div>
				<div class="text-container">
					<p><?php echo $picture->name?></p>
					<p><?php echo $picture->price?></p>
				</div>
			</div>			
		</a>
</div>