<?php
//include_once '../../Classes/include_dao.php';
//include_once '../../utilities/common.php';

$events = DAOFactory::getBlogDAO()->queryAllOrderBy("startDate,endDate");
?>
<div class="row">
<?php foreach ($events as $event) { 
	$startDate = new DateTime($event->startDate);
	$endDate = new DateTime($event->endDate);
	$now = new DateTime();
	if($endDate < $now ) {
		$statusClass = "event-status past";
	} else if ($startDate < $now && $endDate >= $now){
		$statusClass = "event-status present";
	} else {
		$statusClass = "event-status future";
	}
	
	
?>
	<div class="event-entry" data-id="<?php echo $event->id?>">
		<a href="#detail?id=<?php echo $event->id?>" data-id="<?php echo $event->id?>" class="nav detail">
			<div class="event-container <?php echo $statusClass?>">
				<div class="event-header">
					<?php echo $event->title?>
				</div>
				<div class="event-dates">
				<?php echo $startDate->format("d.m.y"). " til " . $endDate->format("d.m.y")?>
				</div>
			</div>			
		</a>
	</div>
<?php }?>
</div>
