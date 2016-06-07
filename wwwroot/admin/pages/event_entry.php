<?php
include_once '../../Classes/include_dao.php';
include_once '../../utilities/common.php';
$id = isset($_GET["id"])?$_GET["id"]:0;

if ($id ==0) {
	$event = new Blog();
	$event->id = 0;
} else { 
	$event = DAOFactory::getBlogDAO()->load($id);
}

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
