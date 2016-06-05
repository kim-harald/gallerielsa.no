<?php
//include_once '../../Classes/include_dao.php';
//include_once '../../utilities/common.php';

$events = DAOFactory::getBlogDAO()->queryAllOrderBy("startDate");
?>
<div class="row">
<?php foreach ($events as $event) { 
	$startDate = new DateTime($event->startDate);
	$endDate = new DateTime($event->endDate);
?>
	<div class="page-element" data-id="<?php echo $picture->id?>">
		<a href="#detail?id=<?php echo $event->id?>" data-id="<?php echo $event->id?>" class="nav detail">
			<div class="item-container">
				<div class="image-container"></div>
				<div class="text-container">
					<p><?php echo $event->title?></p>
					<p><?php echo $startDate->format("d.m.y"). " til " . $endDate->format("d.m.y")?></p>
				</div>
			</div>			
		</a>
	</div>
<?php }?>
</div>
