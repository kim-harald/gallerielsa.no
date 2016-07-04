<?php 
include_once '/Classes/include_dao.php';
include_once '/utilities/common.php';

$events = DAOFactory::getBlogDAO()->queryGetCurrentFuture("startDate,endDate");
?>

<h1 class="left">Arrangementer</h1>
<div class="row">
	<div class="col-sm-3 col-md-3"></div>
	<div class="col-xs-12 col-sm-6 col-md-6">
<?php foreach($events as $v) {
	$startDate = new DateTime($v->startDate);
	$endDate = new DateTime($v->endDate);
?>
	<div class="event-container <?php echo getEventClass($startDate, $endDate)?>" data-id="<?php echo $v->id?>">
		<h2><?php echo $v->title?></h2>
		<div class="event-text">
			<div class="event-date"><?php echo $startDate->format("d.m.Y h:i:s")?></div>
			<div class="event-message"><?php echo htmlspecialchars_decode($v->message)?></div>
		</div>
	</div>
<?php } ?>
	</div>     
	<div class="col-sm-3 col-md-3"></div>
</div>
<?php 
function getEventClass($startDate,$endDate) {
	$now = new DateTime();
	if ($endDate < $now) {
		return "past hidden";
	}
	if ($startDate > $now) {
		return "future";
	}
	
	return "present";
}
?>