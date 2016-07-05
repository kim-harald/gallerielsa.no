<!DOCTYPE html>
<html>
<head>
<?php 
		include("head.php");
		$exhibitions = DAOFactory::getExhibitionDAO()->queryGetCurrentFuture('startDate,endDate',1);
		$events = DAOFactory::getBlogDAO()->queryGetCurrentFuture("startDate,endDate");
?>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<div class="container">
<?php include("header.php"); ?>
	  <div id="Body" class="container-fluid">
        
	  	<div class="col-sm-3 col-md-3"></div>
      <div class="col-xs-12 col-sm-6 col-md-6">
      <div id="Events" class="row">
      	
      	<?php 
      		foreach($events as $event){
      	?>
      	<div class="event">
      		<a href="event.php?id=<?php echo $event->id?>">
      			<h4><?php echo $event->title?></h4>
      		</a>
      		<div class="event-content-container transparent-fade">
	      		<?php echo htmlspecialchars_decode($event->message)?>
	      		<p class="read-more"><a href="#">mer</a></p>
      		</div>
      	</div>		
      		
      	<?php }?>
      	</div>
    
<?php if (isset($exhibitions) && count($exhibitions)>0) {
	$exh = $exhibitions[0];
	$startDate = new DateTime($exh->startDate);
	$endDate = new DateTime($exh->endDate);
	$picture = DAOFactory::getPictureDAO()->queryGetFirstPicture($exh->id);
	//$class = getClass($exh->startDate, $exh->endDate)
?>
      	<div id="CurrentExhibition" class="row">
      		<div class="exhibition">
						<a href="exhibition.php?id=<?php echo $exh->id?>">
							<h4 class=""><?php echo $exh->name?></h4>
							<img src="<?php echo $picture->path?>">
							<p><small><?php echo $picture->name?></small></p>
							<p><?php echo $exh->longDescr." bilde".($exh->longDescr > 1 ?"r":"") ?> </p>
							<p><?php echo $startDate->format("d.m.Y") . ' til ' . $endDate->format("d.m.Y")?></p>
						</a>
	        </div>

				</div>
<?php }?>
			  </div> 	
	    <div class="col-sm-3 col-md-3"></div>

		</div>
<?php include 'footer.php'?>
  </div>
  
  <?//php echo phpinfo()?>
<script>
$(function(){
	setMenuActive("home");
});
</script>
</body>
</html>
<?php 
function getClass($date0,$date1) {
	$today = date('d-m-Y',time());
	$end = date('d-m-Y h:i:s',strtotime($date1));
	$endDate =  date_create($end);
	$start = date('d-m-Y h:i:s',strtotime($date0));
	$startDate = date_create($start);
	$todayDate = date_create($today);
	$futureCount = 0; $currentCount = 0; $pastCount = 0;
	$exhibitionClass = '';
	if ($endDate > $today && $startDate < $today) {
		// current exhibition
		$currentCount++;
		if ($currentCount<=1) {
			$exhibitionClass = 'future-exhibition';
		} else {
			$exhibitionClass = 'hidden';
		}
		$exhibitionClass = 'hidden';
	} else if ($endDate > $todayDate && $startDate > $todayDate) {
		// future exhibition
		$futureCount++;
		if ($futureCount<=1) {
			$exhibitionClass = 'current-exhibition';
		} else {
			$exhibitionClass = 'hidden';
		}
	} else {
		// past exhibition
		$pastCount++;
		if ($pastCount<=0) {
			$exhibitionClass = 'past-exhibition hidden';
		} else {
			$exhibitionClass = 'hidden';
		}
	}
	return $exhibitionClass;
}
?>